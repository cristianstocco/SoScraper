@extends('layouts.app')

@section('content')
<main class="news">
    <section class="top">
        <div class="content">
            <h1>News</h1>
            <p>Here you can find some example on HOW SoCrawler WORKS</p>
        </div>
    </section>

    <section class="news_content">
        <ul id="news" class="container">
            <li>
                <div class="content">
                    @if( Auth::check() && !App\User::isMember() )
                        <a class="button_call" href="/news/create"><span class="text-button">CREATE NEWS</span> <span class="gradient"></span></a>
                    @endif
                </div>
            </li>
            @foreach( $news as $_news )
                <li class="">
                    <div class="content">
                        <div class="box_shadoow">
                            <div class="header">
                                <h2>{{ $_news[ 'title' ] }}</h2>
                                <div class="info_news">
                                    <span class="text_news">{{ $_news[ 'created_at' ] }}
                                        <br>
                                        <span class="text_bold">{{ $_news[ 'writer' ] }}</span>
                                    </span>
                                    <span class="img_admin"><img src="img/admin.svg" alt=""></span>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <p>{{ $_news[ 'message' ] }}</p>
                        </div>
                    </div>

                    <div class="row_colored"></div>
                </li>
            @endforeach
        </ul>
        <div class="content">
            <a href="#" class="button_call" id="load_more">
                <span class="text-button">Load more</span>
                <span class="gradient"></span>
            </a>
            <a href="#" class="button_call" id="no-news">
                <span class="text-button"><img src="img/no-news.svg" alt="">No More News TO LOAD <img src="img/no-news.svg" alt=""></span>
                <span class="gradient"></span>
            </a>
        </div>
    </section>

</main>
@endsection
