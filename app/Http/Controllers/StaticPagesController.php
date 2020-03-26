<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\InfoApiCost;
use App\MediaApiCost;
use Illuminate\Support\Facades\Auth;
use MetzWeb\Instagram\Instagram;

use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendEmailRequest;
use App\Mail\ContactUsMailable;

class StaticPagesController extends Controller
{
    public function index() {
//        $instagram = new Instagram(array(
//            'apiKey'      => 'c2392eaf59404112927508b69d000f1f',
//            'apiSecret'   => 'ba175330ed3345d1b8bafb3f5c4bd49d',
//            'apiCallback' => 'http://agileapis.ideoplayground.com/post'
//        ));
//
//        echo "<a href='{$instagram->getLoginUrl([ 'public_content' ])}'>Login with Instagram</a>";
//        $URI = '/1470116619887798/instant_articles';
//
//        $response = Facebook::fetchRequest( $URI );
//
//        dd( $response );

        return view('welcome');
    }

    public function indexPost() {
        $instagram = new Instagram(array(
            'apiKey'      => 'c2392eaf59404112927508b69d000f1f',
            'apiSecret'   => 'ba175330ed3345d1b8bafb3f5c4bd49d',
            'apiCallback' => 'http://agileapis.ideoplayground.com/post'
        ));

        // grab OAuth callback code
        $code = $_GET['code'];
//        $accessToken = $instagram->getOAuthToken( $code );

//        dd( $data );
//        $instagram->setAccessToken($accessToken);
//
//        $data = $instagram->searchTags('sportland');

        $data = $instagram->getOAuthToken($code, true);
//        $instagram->getLoginUrl([ 'public_content' ]);
//        $username = $data->user->username;
        // store user access token
        $instagram->setAccessToken($data);
        // now you have access to all authenticated user methods
//        $result = $instagram->getUserMedia();
        $result = $instagram->getUserMedia();
//        $result = $instagram->searchTags('sportland');

        dd( $data, $result );
    }

    public function indexNews() {
        $news = News::all();

        for( $i = 0; $i < sizeof( $news ); $i++ ) {
            $news[ $i ][ 'colorIndex' ] = $i % 2 == 1;
            $news[ $i ][ 'created_at' ] = \Carbon\Carbon::parse( $news[ $i ][ 'created_at' ] )->toFormattedDateString();
        }
        $news = array_reverse( $news->toArray() );

        return view( 'news.index', compact( 'news' ) );
    }

    public function createNews() {
        if( Auth::isMember() || is_null(Auth::user()) )
            return view( 'errors.404' );

        return view( 'news.create' );
    }

    public function storeNews( Request $request ) {
        if( Auth::isMember() || is_null(Auth::user()) )
            return view( 'errors.404' );

        if( !isset($request['title']) || !isset($request['message']) || !isset($request['submit']) )
            return redirect( route( 'static_newsCreate' ) );

        News::create([
            'title' => $request[ 'title' ],
            'message' => $request[ 'message' ],
            'isImportant' => isset( $request[ 'isImportant' ] )
        ]);

        return redirect( route( 'static_newsIndex' ) );
    }

    public function indexPricing() {
        $infoApis = InfoApiCost::filterAll();
        $mediaApis = MediaApiCost::filterAll();

        return view( 'pricing', compact( 'infoApis', 'mediaApis' ) );
    }

    public function contactUs( SendEmailRequest $request ) {
      // dd(  $request->all() );
        $name = array();
        $name[ 'name' ] = $request[ 'name' ];

        $subject = $request[ 'subject' ];
        $message = $request[ 'message' ];

        Mail::to( $request[ 'email' ] )
            ->send( (new ContactUsMailable()) );
    }
}
