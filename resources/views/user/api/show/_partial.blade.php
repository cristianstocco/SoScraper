<section class="main">
    <div class="content">
        <h3>PARTIAL MODE</h3>
        @if( sizeof( $apiGroup_partial ) == 0 )

        <p class="error">There are no APIs implemented. @else</p>
        <div class="content_project">

            <ul id="apiHealth">

            @foreach( $apiGroup_partial as $group )

                <li class="group" data-id="{{ $group->basePathKey }}">
                    <h4 class="edge">
                        {{ $group[ 'pageEdge' ] }}
                    </h4>

                    <div class="date_created">
                        <span>created at</span>
                        <time>{{ $group->created_at }}</time>
                    </div>

                    <div class="date_created">
                        <span>updated at</span>
                        <time>{{ $group->updated_at }}</time>
                    </div>
                    <div class="buttons">
                        <a href="" class="delete">Delete</a>

                        <a href="" class="edit">Edit</a>
                        <a href="" class="refreash">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.4" height="12.5" viewBox="0 0 17.4 12.5">
                              <style>
                                .st0{fill:#251721;}
                              </style>
                              <path class="st0" d="M17.3 5.6C17 2.7 14.2.4 10.7 0 6.1-.4 2.2 2.5 2.2 6.2h-2c-.2 0-.2.1-.2.2l3.1 3.5c.1.1.2.1.2 0l3.1-3.5c.1-.1 0-.2-.1-.2h-2c0-2.6 2.7-4.7 5.9-4.5 2.7.2 4.9 2 5.1 4.3.2 2.4-1.9 4.4-4.6 4.8-.5.1-.9.4-.9.9s.6.9 1.2.9c3.9-.6 6.8-3.6 6.3-7z"/>
                            </svg>
                        </a>

                    </div>
                </li>

            @endforeach
            </ul>
        </div>
    </div>
</section>
@import('partials.overlay')
@endif