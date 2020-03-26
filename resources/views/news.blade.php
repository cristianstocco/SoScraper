@extends('layouts.app')

@section('content')

    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        NEWS
    </div>

    @if( Auth::isAdmin() || Auth::isModerator() )
        <div>
            <a href="/news/create">CREATE NEWS</a>
        </div>
    @endif

    <div id="news" class="container">
        @foreach( $news as $_news )
            <div class="row">
                <div class="{{ $_news[ 'colorIndex' ] == 1 ? 'callout-dark' : 'callout-bubble' }} text-center fade-in-b">
                    <h1>{{ $_news[ 'title' ] }}</h1>
                    
                    <p class="header">written by {{ $_news[ 'writer' ] }} in {{ $_news[ 'created_at' ] }}</p>
                    
                    <p>{{ $_news[ 'message' ] }}</p>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection
