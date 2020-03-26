@extends( 'layouts.app' )

@section( 'content' )
<main id="dashboard">
    @include( 'partials.overlay' )
    
    <section class="top_dashboard">
        <div class="notifiche" style="display: none">
            <div class="content">
                <p>Nome della pagina succesfully updated</p>
            </div>
        </div>
        <div class="respond"></div>

        <div class="content">
            <h1>Dashboard</h1>
            {{--
            <ul>
                <li><a href="#" data-hover="Overview">Overview</a></li>
                <li><a href="#" data-hover="API Health">API Health</a></li>
                <li><a href="#" data-hover="Api Statistics">Api Statistics</a></li>
            </ul>
            --}}
         </div>
    </section>
    <section class="dashboard">
        <div class="notification">
            <div class="content">
                <h2>Notification</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat mauris erat, in varius ligula pulvinar ac. Duis at scelerisque eros, facilisis malesuada justo.

                    In posuere sagittis tellus Nullam ultrices dignissim odio eu venenatis. Nam malesuada varius lobortis. Pellentesque finibus tristique lectus id molestie. Donec sed luctus quam, quis tempor odio. Mauris tempus nulla ipsum, laoreet venenatis nisl facilisis et.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat mauris erat, in varius ligula pulvinar ac. Duis at scelerisque eros, facilisis malesuada justo.
                </p>

            </div>
        </div>
    </section>  
    <section class="main">
        <div class="content">
            
            @if( sizeof($apiGroup_full) )
                <h3>FULL</h3>
                <hr class="small_row">

            @endif
            @foreach( $apiGroup_full as $groups )
                <div class="content_project">
                    <h3>{{ $groups[0][ 'name' ] }}</h3>
                    <h4><a href="//www.facebook.com/{{ $groups[0][ 'source' ] }}/" target="_blank">{{ $groups[0][ 'source' ] }}</a></h4>
                    
                    <ul class="apiHealth">
                        @foreach( $groups as $api )
                            <li class="group" data-id="{{ $api[ 'basePathKey' ] }}">
                                <h4 class="edge">
                                    {{ $api[ 'pageEdge' ] }}
                                </h4>

                                <div class="date_created">
                                    <span>created at</span>
                                    <time>{{ $api[ 'created_at' ] }}</time>
                                </div>

                                <div class="date_created">
                                    <span>updated at</span>
                                    <time>{{ $api[ 'updated_at' ] }}</time>
                                </div>
                                <div class="buttons">
                                    <a href="#" class="delete">Delete</a>

                                    <a href="#" class="edit">Edit</a>
                                    <a href="#" class="refresh">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.4" height="12.5" viewBox="0 0 17.4 12.5">
                                          <style>
                                            .st0{fill:#251721;}
                                          </style>
                                          <path class="st0" d="M17.3 5.6C17 2.7 14.2.4 10.7 0 6.1-.4 2.2 2.5 2.2 6.2h-2c-.2 0-.2.1-.2.2l3.1 3.5c.1.1.2.1.2 0l3.1-3.5c.1-.1 0-.2-.1-.2h-2c0-2.6 2.7-4.7 5.9-4.5 2.7.2 4.9 2 5.1 4.3.2 2.4-1.9 4.4-4.6 4.8-.5.1-.9.4-.9.9s.6.9 1.2.9c3.9-.6 6.8-3.6 6.3-7z"/>
                                        </svg>
                                    </a>
                                </div>
                                
                                <ul class="full_buttons buttons">
                                    <li class="col2"><a href="/api/show/{{ $api[ 'basePathKey' ] }}">Show</a></li>
                                    <li class="col2"><a href="/api/statistics/{{ $api[ 'basePathKey' ] }}">Statistics</a></li>
                                </ul>
                            </li>
                        @endforeach

                        @for( $i = 0; $i < 5 - sizeof($groups); $i++ )
                            <li class="group" data-id=""></li>
                        @endfor
                    </ul>
                </div>
            @endforeach
            
            @if( sizeof($apiGroup_partial) )
                <h3>PARTIALS</h3>
                <hr class="small_row">

            @endif
            @foreach( $apiGroup_partial as $group )
                <div class="content_project">
                    <h3>{{ $group->name }}</h3>
                    <h4><a href="//www.facebook.com/{{ $group->source }}/" target="_blank">{{ $group->source }}</a></h4>
                    
                    <ul class="apiHealth">
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
                                <a href="#" class="delete">Delete</a>

                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="refresh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17.4" height="12.5" viewBox="0 0 17.4 12.5">
                                      <style>
                                        .st0{fill:#251721;}
                                      </style>
                                      <path class="st0" d="M17.3 5.6C17 2.7 14.2.4 10.7 0 6.1-.4 2.2 2.5 2.2 6.2h-2c-.2 0-.2.1-.2.2l3.1 3.5c.1.1.2.1.2 0l3.1-3.5c.1-.1 0-.2-.1-.2h-2c0-2.6 2.7-4.7 5.9-4.5 2.7.2 4.9 2 5.1 4.3.2 2.4-1.9 4.4-4.6 4.8-.5.1-.9.4-.9.9s.6.9 1.2.9c3.9-.6 6.8-3.6 6.3-7z"/>
                                    </svg>
                                </a>
                            </div>
                            <ul class="full_buttons buttons">
                                <li class="col2"><a href="/api/show/{{ $group->basePathKey }}">Show</a></li>
                                <li class="col2"><a  href="/api/statistics/{{ $group->basePathKey }}">Statistics</a></li>
                            </ul>   
                        </li>
                    </ul>
                </div>
            @endforeach
            
            @if( sizeof($apiGroup_info) )
               <h3>INFO</h3>
               <hr class="small_row">
            @endif
            @foreach( $apiGroup_info as $group )
                <div class="content_project">
                    <h3>{{ $group->name }}</h3>
                    <h4><a href="//www.facebook.com/{{ $group->source }}/" target="_blank">{{ $group->source }}</a></h4>
                    
                    <ul class="apiHealth">
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
                                <a href="#" class="delete">Delete</a>

                                <a href="#" class="edit">Edit</a>
                                <a href="#" class="refresh">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17.4" height="12.5" viewBox="0 0 17.4 12.5">
                                      <style>
                                        .st0{fill:#251721;}
                                      </style>
                                      <path class="st0" d="M17.3 5.6C17 2.7 14.2.4 10.7 0 6.1-.4 2.2 2.5 2.2 6.2h-2c-.2 0-.2.1-.2.2l3.1 3.5c.1.1.2.1.2 0l3.1-3.5c.1-.1 0-.2-.1-.2h-2c0-2.6 2.7-4.7 5.9-4.5 2.7.2 4.9 2 5.1 4.3.2 2.4-1.9 4.4-4.6 4.8-.5.1-.9.4-.9.9s.6.9 1.2.9c3.9-.6 6.8-3.6 6.3-7z"/>
                                    </svg>
                                </a>
                            </div>
                            <ul class="full_buttons buttons">
                                <li class="col2"><a href="/api/show/{{ $group->basePathKey }}">Show</a></li>
                                <li class="col2"><a href="/api/statistics/{{ $group->basePathKey }}" >Statistics</a></li>
                            </ul>   
                        </li>
                    </ul>
                </div>
            @endforeach
            
            <ul class="apiHealth">
                <li class="group" data-id="">
                    <a href="{{ route( 'api.createInit' ) }}" class="new_api">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42.3" height="43.5" viewBox="0 0 42.3 43.5">
                          <style>
                            .st0{fill:#251721;}
                          </style>
                          <path class="st0" d="M25.4 0v17.8h16.9v7.9H25.4v17.8h-8.6V25.7H0v-7.9h16.8V0"/>
                        </svg>
                        <span>CREATE API</span>
                    </a>
                </li>
            </ul>
            
    </section>
    
    <div class="contact_form" id="chooses"></div>

</main>
    

@stop