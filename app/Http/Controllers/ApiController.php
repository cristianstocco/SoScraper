<?php

namespace App\Http\Controllers;

use App\FB_api_group_full_mode;
use App\FB_api_info;
use App\FB_api_partial_mode;
use App\FB_api_group_partial_mode;
use App\FB_api_resource;
use App\FB_page_edge;
use App\FB_api_mode;
use App\FB_page_field;
use App\FB_requests_dates_full_mode;
use App\FB_requests_dates_info;
use App\FB_requests_dates_partial_mode;
use App\MediaApiCost;
use App\Provider;
use App\User;
use App\ApiDiscount;

use Carbon\Carbon;
use Facebook\Facebook;
use Facebook\Url\FacebookUrlManipulator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

//  Request
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Illuminate\Support\Facades\Auth;
use RandomLib\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

define( 'Facebook', app_path() . '/Facebook/src/Facebook/' );
require_once( Facebook . 'autoload.php' );

class ApiController extends Controller
{

    const SOURCE_NOT_EXISTING_ERROR = 'The source does not exist. Check www.facebook.com/';
    const SOURCE_NOT_VALID_ERROR = 'The source is not valid.';
    const MODE_NOT_VALID_ERROR = 'The mode is not valid.';
    const HEADER_NO_STORE = [ 'Cache-Control' => 'no-store', 'Pragma' => 'no-store', 'Expires' => '0' ];

    /**
     * Show the form for creating a new resource, STEP 1.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInit() {
        $source = session( 'sourcePage' );

        $providers = Provider::all();

        return response()
            ->view( 'user.api.create.source', compact( 'providers', 'source' ) )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Determinating the page for creating a new resource, STEP 2.
     */
    public function createHubFilter( Request $request ) {
        session()->forget( 'sourcePage' );
        $URI = $request[ 'source' ];

        //  no uri given
        if( is_null($URI) || !strlen($URI) )
            return redirect( route('api.createInit') )->with( 'status', self::SOURCE_NOT_VALID_ERROR );

        $sourcePage = FacebookUrlManipulator::pageEndpoint( $URI );
        $isValid = Facebook::fetchRequest( $sourcePage )[ 'success' ];

        //  given uri not valid
        if( !$isValid )
            return redirect( route('api.createInit') )->with( 'status', self::SOURCE_NOT_EXISTING_ERROR . $sourcePage );



        session(['sourcePage' => $sourcePage]);
        $mode = FB_api_mode::getMode( $request[ 'mode' ] );

        if( !is_array($mode) )
            return redirect( route('api.createInit') )->with( 'status', self::MODE_NOT_VALID_ERROR );

        session()->forget( 'apis' );
        session()->forget( 'edges' );
        session()->forget( 'infoFields' );
        session()->forget( 'apisSettings' );
        session( ['mode' => $mode] );

        if( $mode[ 'isInfo' ] )
            return $this->createInfo();

        else
            return $this->createEdges();
    }

    /**
     * Show the form for creating a new resource, STEP 2.1.1.
     */
    private function createInfo() {
        $infos = FB_page_field::allWithInputName();
        $source = session( 'sourcePage' );

        return response()
            ->view( 'user.api.create.filter.info', compact( 'infos', 'source' ) )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Show the form for creating a new resource, STEP 2.1.2.
     *
     * @return \Illuminate\Http\Response
     */
    private function createEdges() {
        $edges = FB_page_edge::all()->where( 'toBeSupported', 1 );

        return response()
            ->view( 'user.api.create.filter.edges', compact( 'edges' ), 200 )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Show the partial view for creating a new resource, STEP 2.2.1.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEdgeContent( Request $request ) {
        $content = $request[ "content" ];
        $isValid = FB_page_edge::exists( $content );

        if( !$isValid ) {
            session()->flash('status', 'The media is not valid.');
            return response( json_encode( array('location' => route('api.createSourceGET')) ) )->header( 'Content-Type', 'application/json' );
        }

        session( ['lastEdge' => $content] );

        //  Fields to build the request
        $fields = DB::table( 'fb_page_edge' )
            ->where('fb_page_edge.endPath', '=', $content)
            ->join('_fb_parent_field', '_fb_parent_field.edge', '=', 'fb_page_edge.endPath')
            ->join('fb_field', '_fb_parent_field.field', '=', 'fb_field.query')
            ->get();

        //  Edges
        $edgeNodes = DB::table( '_fb_edge_edgenode' )
            ->where('_fb_edge_edgenode.edge', '=', $content)
            ->where('_fb_edge_edgenode.isDefault', '=', 0)
            ->join('fb_page_edge_node', '_fb_edge_edgenode.edgeNode', '=', 'fb_page_edge_node.endPath')
            ->get();

        //  Edge nodes
        $defaultNodes = DB::table( '_fb_edge_edgenode' )
            ->where('_fb_edge_edgenode.edge', '=', $content)
            ->where('_fb_edge_edgenode.isDefault', '=', 1)
            ->get();

        //  Recursive requests to be done
        $followingRequests = DB::table( '_fb_field_followingrequest' )->get();

        $_fields = "?fields=";
        $fieldsNo = sizeof( $fields );
        $i = 0;
        foreach( $fields as $field ) {
            $_fields .= $field->field;

            if( ++$i != $fieldsNo )
                $_fields .= ',';
        }

        for( $i = 0; $i < sizeof($edgeNodes); $i++ ) {
            $userLink = 'mediaSelector_' . mt_rand();
            $edgeNodes[ $i ]->userLink = $userLink;

            session()->push( 'edgeNodes', array(
                'endPath' => $edgeNodes[ $i ]->endPath,
                'userLink' => $userLink
            ));
        }

        $URI = '/' . session('sourcePage') . '/' . $content . $_fields;

        if( session( 'mode' ) && session( 'mode' )[ 'toFetchMedia' ] ) {
            $response = Facebook::fetchRequest( $URI );
            $responseData = $response[ 'response' ][ 'data' ];

            if( $response[ 'success' ] ) {
                for( $i = 0; $i < sizeof($responseData); $i++ ) {
                    $edge = $responseData[ $i ];

                    /*
                     * Fetching every following request given from the response ( ALBUMS -> cover_photo )
                     * */
                    foreach( array_keys($edge) as $edgeKey )
                        foreach( $followingRequests as $followingRequest )
                            if( $followingRequest->parentField == $edgeKey ) {

                                $fields = $followingRequest->field;
                                $nodeID = $edge[ $edgeKey ][ "id" ];
                                $URI = $nodeID . "?fields=" . $fields;
                                $followingRequestResponse = Facebook::fetchRequest( $URI )[ 'response' ];

                                $responseData[ $i ][ "cover_photo" ] = $followingRequestResponse;

                            }

                    /*
                     * User interface link
                     * */
                    $responseData[ $i ][ 'userLink' ] = 'media_' . mt_rand();

                    /*
                     * Fetching every defaultNode which should be dispatched
                     * */
                    foreach( $defaultNodes as $node ) {
                        $nodeID = $edge['id'];
                        $URI = $nodeID . '/' . $node->edgeNode . "?fields=" . $node->defaultField;
                        $node_responseData = Facebook::fetchRequest( $URI )[ 'response' ][ 'data' ][ 0 ];

                        $responseData[ $i ][ $node->relativeRoot ][ $node->defaultField ] = $node_responseData[ $node->defaultField ];
                    }

                    //  Storing into session
                    session()->push( 'edgeNodes', array(
                        'id' => $responseData[ $i ][ 'id' ],
                        'userLink' => $responseData[ $i ][ 'userLink' ]
                    ));

                }

                if( !sizeof($responseData) )
                    return view( 'user.api.content.void' );

                return view( 'user.api.content.'.$content, compact( 'responseData', 'edgeNodes' ) );
            }
            else {
                session()->flash('status', 'Something has wrong, sorry for the inconvenient, we are working for you.');
                return response( json_encode( array('location' => route('api.createInit')) ) )->header( 'Content-Type', 'application/json' );
            }
        }
        else {
            $response = Facebook::fetchRequest( $URI );

            if( isset($response[ 'error' ]) )
                return response( json_encode( array('location' => route('api.createInit')) ) )->header( 'Content-Type', 'application/json' );

            return response()
                ->view( 'user.api.content._content', compact( 'edgeNodes' ) )
                ->withHeaders( self::HEADER_NO_STORE );
        }

    }

    /**
     * Routing the storing of partial resource, STEP 2.2.2.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPartial( Request $request )
    {
        $isFullMode = session( 'mode' )[ 'isFull' ];

        if( $isFullMode )
            return $this->createPartialFullMode( $request );
        else
            return $this->createPartialPartialMode( $request );
    }

    /**
     * Saving into the session the new partial resource, STEP 2.2.2.1.
     *
     * @return \Illuminate\Http\Response
     */
    private function createPartialFullMode( $request ) {
        //  Edges
        $edgeNodes = session( 'edgeNodes' );
        $lastEdge = session( 'lastEdge' );

        //dd( "Cambiare edgeNodes on session", $user_edgeNodes );

        $post = $request->all();
        $post_mediaSelectors = array();

        /*
         * Building POST data
         * */
        $mediaSelectorQuery = "mediaSelector_";
        foreach( $post as $key => $value )
            if( is_integer( strpos($key, $mediaSelectorQuery) ) )
                foreach( $edgeNodes as $edgeNode )
                    if( $edgeNode[ 'userLink' ] == $key )
                        array_push(
                            $post_mediaSelectors,
                            array(
                                'key' => $key,
                                'endPath' => $edgeNode[ 'endPath' ]
                            )
                        );

        if( !sizeof( $post_mediaSelectors ) )
            return view( 'user.api.storePartial.error' );

        session()->push( 'apis', array('mediaSelector' => $post_mediaSelectors, 'edge' => $lastEdge, 'key' => mt_rand(), 'isFull' => true) );
        session()->forget( 'edgeNodes' );

        return response()
            ->view( 'user.api.storePartial.success' )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Saving into the session the new partial resource, STEP 2.2.2.2.
     *
     * @return \Illuminate\Http\Response
     */
    private function createPartialPartialMode( $request ) {
        //  Edges
        $user_edgeNodes = session( 'edgeNodes' );
        $edgeNodes = session( 'edgeNodes' );
        $lastEdge = session( 'lastEdge' );

        //dd( "Change edgeNodes on session", $user_edgeNodes );

        $post = $request->all();
        $post_mediaSelectors = array();
        $post_media = array();

        /*
         * Building POST data
         * */
        $mediaSelectorQuery = "mediaSelector_";
        foreach( $post as $key => $value )
            if( is_integer( strpos($key, $mediaSelectorQuery) ) )
                foreach( $edgeNodes as $edgeNode )
                    if( $edgeNode[ 'userLink' ] == $key )
                        array_push(
                            $post_mediaSelectors,
                            array(
                                'key' => $key,
                                'endPath' => $edgeNode[ 'endPath' ]
                            )
                        );

        /*
         * Building POST data
         * */
        $mediaQuery = "media_";
        foreach( $post as $key => $value )
            if( is_integer( strpos($key, $mediaQuery) ) )
                foreach( $user_edgeNodes as $edgeNode )
                    if( $edgeNode[ 'userLink' ] == $key )
                        array_push(
                            $post_media,
                            array(
                                'key' => $key,
                                'endPath' => $edgeNode[ 'id' ]
                            )
                        );

        if( !sizeof( $post_mediaSelectors ) || !sizeof( $post_media ) )
            return view( 'user.api.storePartial.error' );

        session()->push( 'apis', ['media' => $post_media, 'mediaSelector' => $post_mediaSelectors, 'edge' => $lastEdge, 'key' => mt_rand(), 'isFull' => false] );
        session()->forget( 'edgeNodes' );

        return response()
            ->view( 'user.api.storePartial.success' )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Show the form for creating a new resource, STEP 3.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSettings( Request $request ) {
        $isInfoMode = session( 'mode' )[ 'isInfo' ];

        if( $isInfoMode ) {

            $fields = FB_page_field::getFields( $request );

            if( sizeof($fields) || is_string(session('status')) ) {
                session( ['infoFields' => $fields] );

                return response()
                    ->view( 'user.api.create.settings' )
                    ->withHeaders( self::HEADER_NO_STORE );
            }
            else
                return redirect( route('api.createSourceGET') )->with( 'status', 'You have not selected any info about your page.' );
        }
        else
            return response()
                ->view( 'user.api.create.settings' )
                ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Creating a new resource, STEP 4.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReview( Request $request ) {
        $hosts = new HostWhitelistController( $request[ 'noWhiteList' ], 0, $request[ 'whiteListDomain' ], $request[ 'whiteListStagingIP' ] );
        $isInfo = session( 'mode.isInfo' );

        if( !$hosts->isSuccessfullyProcessed )
            return redirect(route('api.createSettingsGET'))->with('status', $hosts->error);

        $whiteListDomain = $hosts->whiteListDomain;
        $whiteListStagingIP = $hosts->whiteListStagingIP;
        $missingDaysToWhiteList = $hosts->missingDaysToWhiteList;

        session( ['apisSettings' => [
                                        'whiteListDomain' => $whiteListDomain,
                                        'whiteListStagingIP' => $whiteListStagingIP,
                                        'missingDaysToWhiteList' => $missingDaysToWhiteList
                                    ]
        ]);

        $SE_mode = session( 'mode' );
        $mode = $SE_mode[ 'isFull' ] ? 'Full' : ( $SE_mode[ 'isInfo' ] ? 'Info' : 'Partial' );
        $apiNumber = sizeof( session('apis') );
        $apiRates = MediaApiCost::filter( MediaApiCost::where( 'servicesNo', '>', $apiNumber )->orWhere( 'servicesNo', -1 )->get()->toArray() );

        $monthDiscounts = ApiDiscount::all()->toArray();

        if( User::isAdmin() || User::isModerator() )
            $nextStepFlow = route( 'api.storeByAdmin' );
        else
            $nextStepFlow = route( 'api.checkout.index' );

        return response()
            ->view( 'user.api.create.review', compact( 'mode', 'apiNumber', 'apiRates', 'monthDiscounts', 'nextStepFlow' ) )
            ->withHeaders( self::HEADER_NO_STORE );
    }

    /**
     * Display the specified resource.
     *
     * @param   int     $id
     * @return  \Illuminate\Http\Response
     */
    public function refresh( $id ) {
        session()->forget( 'apiFetcher' );
        $apiResource = FB_api_resource::where( ['basePathKey' => $id, 'user' => Auth::user()->id] );

        if( is_object( $apiResource ) ) {
            $apiResource = $apiResource->get()[ 0 ];
            $mode = $apiResource->mode;

            Artisan::call( "fbapi:$mode", ['basePathKey' => $apiResource->basePathKey] );

            if( session('apiFetcher.element.isFetched') )
                return view('user.api.refresh.success');
            else
                return view('user.api.refresh.error');
        }
        else
            return view('user.api.refresh.error');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function show() {
//        $apiGroup_info = FB_api_info::where( 'user', Auth::user()->id )->get();
//        $apiGroup_partial = FB_api_group_partial_mode::where( 'user', Auth::user()->id )->get();
//        $apiGroup_full = FB_api_group_full_mode::where( 'user', Auth::user()->id )->get();
//
//        return view('user.api.show.index', compact( 'apiGroup_info', 'apiGroup_partial', 'apiGroup_full' ));
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showElement( $id ) {
        $apiResource = FB_api_resource::where( ['basePathKey' => $id, 'user' => Auth::user()->id] );

        if( is_object( $apiResource ) ) {
            $apiResource = $apiResource->get()[ 0 ];
            $mode = $apiResource->mode;

            if( $mode == 'info' )
                return view('user.api.show.infoApi', compact( 'apiResource' ));
            else {
                $apis = DB::table('fb_api_' . $mode . '_mode')
                    ->join('fb_api_group_' . $mode . '_mode', 'fb_api_group_' . $mode . '_mode.id_api_group', '=', 'fb_api_' . $mode . '_mode.groupApi')
                    ->where('fb_api_group_' . $mode . '_mode.basePathKey', $id)->get();
                $groupApi = DB::table('fb_api_group_' . $mode . '_mode')
                    ->where('basePathKey', $id)
                    ->get()[ 0 ];

                if( sizeof($apis) == 0 )
                    return json_encode( [ 'success' => false ] );

                return view('user.api.show.mediaGroupApi', compact('apis', 'groupApi'));
            }
        }
        else
            return response( json_encode( ['success' => false ]) )->header( 'Content-Type', 'application/json' );
    }

    /**
     * Show the statistics for the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics( $id ) {
        return view('user.api.statistics.index', compact( 'id' ));
    }

    /**
     * Show the statistics for the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function statisticsAPI( $id ) {
        $DB_apiGroup = FB_api_resource::where( ['basePathKey' => $id, 'user' => Auth::user()->id] );
        if( is_null($DB_apiGroup) )
            return response( json_encode( array('success' => false) ) )->header( 'Content-Type', 'application/json' );

        //  Requests Done
        $apiRequestsDates = FB_requests_dates_full_mode::where( 'groupApi', $DB_apiGroup->get()[ 0 ]->id_api_group )->get()->toArray();

        //  Removing unused keys
        for( $i = 0; $i < sizeof($apiRequestsDates); $i++ )
            array_forget( $apiRequestsDates[ $i ], ['id', 'groupApi'] );

        return response( json_encode( ['success' => true, 'data' => $apiRequestsDates] ) )->header( 'Content-Type', 'application/json' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $apiResource = FB_api_resource::where( ['basePathKey' => $id, 'user' => Auth::user()->id] );

        if( is_object( $apiResource ) ) {
            $apiResource = $apiResource->get()[ 0 ];

            $missingDaysToWhiteList = $apiResource->missingDaysToWhiteList;

            session( ['apiResource' => $apiResource] );

            return view( 'user.api.edit.index', compact( 'apiResource', 'missingDaysToWhiteList' ) );
        }
        else
            return response( json_encode( array('success' => false) ) )->header( 'Content-Type', 'application/json' );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $apiResource = session( 'apiResource' );
        $id = $apiResource->basePathKey;
        $apiResourceToUpdate = FB_api_resource::where( ['basePathKey' => $id, 'user' => Auth::user()->id] );


        $hosts = new HostWhitelistController( $request[ 'noWhiteList' ], $apiResource->missingDaysToWhiteList, $request[ 'whiteListDomain' ], $request[ 'whiteListStagingIP' ] );
        if( !$hosts->isSuccessfullyProcessed ) {
            session()->flash('status', $hosts->error);
            return view( 'user.api.edit.index', compact( 'apiResource', $apiResource->missingDaysToWhiteList) );
        }
        $whiteListDomain = $hosts->whiteListDomain;
        $whiteListStagingIP = $hosts->whiteListStagingIP;
        $missingDaysToWhiteList = $hosts->missingDaysToWhiteList;


        if( is_object($apiResourceToUpdate) ) {
            $apiResourceToUpdate->update([
                'whiteListDomain' => $whiteListDomain,
                'whiteListStagingIP' => $whiteListStagingIP,
                'missingDaysToWhiteList' => $missingDaysToWhiteList
            ]);

            return view( 'user.api.update.success' );
        }
        else {
            session()->flash('status', 'Not valid API group.');
            return view( 'user.api.edit.index', compact( 'apiResource' ) );
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $userID = Auth::user()->id;
        $isProcessedSuccessfully = FB_api_resource::deleteCollection( $id, $userID );

        if( $isProcessedSuccessfully )
            return response( json_encode(array(
                'success' => true,
                'message' => 'The API group and related APIs have been successfully deleted.'
            ) ) )->header( 'Content-Type', 'application/json' );
        else
            return response( json_encode(array(
                'success' => false,
                'message' => 'The API group do not exist.'
            ) ) )->header( 'Content-Type', 'application/json' );

    }
}
