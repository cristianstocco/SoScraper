@if( sizeof($apiGroups_full) )
    <div class="general-title">
        APIs full
    </div>

    <section id="apiGroup">
        @foreach( $apiGroups_full as $group )

            <article class="group">

                <div class="details">
                    <div class="edge">
                        Edge: {{ $group[ 'pageEdge' ] }}
                    </div>

                    <div class="description">
                        Link: <a target="_blank" href="http://api.agileapis.ideoplayground.com/{{ $group->basePathKey }}">http://api.agileapis.ideoplayground.com/{{ $group->basePathKey }}</a>
                    </div>
                </div>

                <section id="dates">

                    <div class="lastUpdate">
                        Last update: {{ $group->formattedUpdated_at }}
                    </div>

                    <div class="totalUpdates">
                        Total updates from creating: {{ $group->totalUpdates }}
                    </div>

                    @foreach( $apiRequestsDates_full as $requestsDates )
                        @if( $requestsDates->groupApi == $group->id_api_group )
                            <div>
                                <p class="date">Date: {{ $requestsDates->formattedDate }}</p>

                                <p class="requests">Requests: {{ $requestsDates->requestsNo }}</p>
                            </div>
                        @endif
                    @endforeach
                    <div style="clear:both"></div>
                </section>

            </article>

        @endforeach
    </section>
@endif