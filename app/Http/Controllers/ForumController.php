<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ForumSection;
use App\ForumTopic;
use App\ForumComment;
use Illuminate\Support\Facades\Auth;
use Spatie\String;
use RandomLib\Factory;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = ForumSection::all()->toArray();
        
        return view( 'forum.index', compact( 'sections' ) );
    }
    
    /**
     * Display a listing feature posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function feature() {
        $typology = 'feature';
        $topics = ForumTopic::where( 'section', $typology )->get()->toArray();
        $topics = self::setShortTextToTopics( $topics );
        $topics = self::setRoute( $topics );
        
        return view( 'forum.section', compact( 'topics', 'typology' ) );
    }
        
    /**
     * Display a listing support posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function support() {
        $typology = 'support';
        $topics = ForumTopic::where( 'section', $typology )->get()->toArray();
        $topics = self::setShortTextToTopics( $topics );
        $topics = self::setRoute( $topics );
        
        return view( 'forum.section', compact( 'topics', 'typology' ) );
    }
        
    /**
     * Display a listing request posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function request() {
        $typology = 'request';
        $topics = ForumTopic::where( 'section', $typology )->get()->toArray();
        $topics = self::setShortTextToTopics( $topics );
        $topics = self::setRoute( $topics );
        
        return view( 'forum.section', compact( 'topics', 'typology' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = ForumSection::all();
        
        return view( 'forum.create', compact( 'sections' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factory = new Factory();
        $generator = $factory->getLowStrengthGenerator();
        
        $title = $request[ 'title' ];
        $message = $request[ 'message' ];
        $section = $request[ 'section' ];
        $isSectionValid = sizeof( ForumSection::where( 'name', $section )->get() ) == 1;
        
        if( strlen($title) != 0 && strlen($message) != 0 && $isSectionValid ) {
            do {
                $topicID = $generator->generateString( 8 );
                $topicExists = sizeof( ForumTopic::where( 'ID', $topicID )->get() ) == 1;
                
                if( !$topicExists ) {
                    ForumTopic::create([
                        'ID' => $topicID,
                        'title' => $title,
                        'message' => $message,
                        'author' => Auth::user()[ 'username' ],
                        'section' => $section
                    ]);
                }
            }
            while( $topicExists );
            
            return view( 'forum.success' );
        }
        else
            return view( 'forum.error' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($section, $id)
    {
        $isSectionValid = sizeof( ForumSection::where( 'name', $section )->get() ) == 1;
        
        if( $isSectionValid ) {
            $topic = ForumTopic::where( 'ID', $id )->get();
            
            if( sizeof( $topic ) == 1 ) {
                $topic = $topic[ 0 ];
                $topic[ 'route' ] = route( 'forum.comment', ['section' => $section, 'id' => $id] );
                $comments = ForumComment::where( 'topicID', $id )->get()->toArray();
                
                return view( 'forum.show', compact('topic', 'comments') );
            }
            
            else
                return redirect( route('static_forum.index') );
        }
        else
            return redirect( route('static_forum.index') );
    }

    /**
     * Show the form for commenting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment($section, $id, Request $request)
    {
        $isSectionValid = sizeof( ForumSection::where( 'name', $section )->get() ) == 1;
        
        if( $isSectionValid ) {
            $topic = ForumTopic::where( 'ID', $id )->get();
                    
            if( sizeof( $topic ) == 1 ) {
                $topic = $topic[ 0 ];
                $request->session()->push('forum.comment.id', $topic[ 'ID' ]);
                
                return view( 'forum.comment', compact( 'topic' ) );
            }
            else
                return redirect( route('static_forum.index') );
        }
        else
            return redirect( route('static_forum.index') );
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commentStore( Request $request )
    {
        $commentData = $request->session()->pull( 'forum.comment' );
        $comment = $request[ 'message' ];
        
        if( is_array($commentData) && $comment && strlen($comment) > 0 ) {
            ForumComment::create([
                'topicID' => $commentData[ 'id' ][ 0 ],
                'message' => $comment,
                'author' => Auth::user()[ 'username' ]
            ]);
            
            return view( 'forum.comment.success' );
        }
        else
            return view( 'forum.comment.error' );
    }
    
    /**
     * Shorten the text for the preview.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setShortTextToTopics( $topics ) {
        for( $i = 0; $i < sizeof($topics); $i++ )
            $topics[ $i ][ 'message' ] = String( $topics[ $i ][ 'message' ] )->tease( 20 );
        
        return $topics;
    }
    
    /**
     * Set route for every topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setRoute( $topics ) {
        for( $i = 0; $i < sizeof($topics); $i++ )
            $topics[ $i ][ 'route' ] = route( 'forum.show', ['section' => $topics[ $i ][ 'section' ], 'id' => $topics[ $i ][ 'ID' ] ] );
        
        return $topics;
    }
}
