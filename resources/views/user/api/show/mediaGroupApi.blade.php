@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
            <h1>Your details APIs</h1>
            <div class="key">Key: {{ $groupApi->basePathKey }}</div>
            <div class="url">URL: <a href="http://api.agileapis.it/{{ $groupApi->basePathKey }}" target="_blank">http://api.agileapis.it/{{ $groupApi->basePathKey }}</a></div>
         </div>
    </section>
    <section class="main">
        <div class="content">
            <a class="button_back" href="/dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.6" height="11.9" viewBox="0 0 14.6 11.9"><style>.st0{clip-path:url(#SVGID_2_);} .st1{clip-path:url(#SVGID_4_);}</style><defs><path id="SVGID_1_" d="M0 0h14.6v11.9H0z"/></defs><clipPath id="SVGID_2_"><use xlink:href="#SVGID_1_" overflow="visible"/></clipPath><path class="st0" d="M14 5.9H.2c-.1 0-.2-.1-.2-.2s.1-.2.2-.2H14c.1 0 .2.1.2.2s-.1.2-.2.2zm0 0"/><path class="st0" d="M5.7 11.3c-.1 0-.1 0-.2-.1L.1 5.8c-.1 0-.1-.1-.1-.1 0-.1 0-.1.1-.2L5.5.1c.1-.1.2-.1.3 0 .1.1.1.2 0 .3L.5 5.7 5.8 11c.1.1.1.2 0 .3h-.1zm0 0"/></svg>
                <span>dashboard</span>
            </a>
            <h3>Your details about APIs are the following:</h3>
            <div class="content_project">

                <ul id="apiHealth">
                    @foreach( $apis as $api )
                    <li class="group" >
                        <h4 class="edge">
                            {{ $api->pageEdge }}

                          
                        </h4>
                        <div class="endPath">
                            <a class="text_overflow" href="https://www.facebook.com/{{ $api->base }}" target="_blank">url: <span> {{ $api->base }}</span></a>

                            <span class="label">Tipologia api:</span>
                            <span>{{ $api->endPath }}</span>
                        </div>
                        <div class="date_created">
                            <span>created at</span>
                            <time>{{ $api->created_at }}</time>
                        </div>
                        <div class="date_created">
                            <span>updated at</span>
                            <time>{{ $api->updated_at }}</time>
                        </div>
                    </li>
        @endforeach
                </ul>
            </div>
        </div>
    </section>
</main>
@endsection