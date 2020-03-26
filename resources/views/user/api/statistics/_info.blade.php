@if( sizeof($apis_info) )
    <div class="general-title">
        APIs Info
    </div>

    <section id="apiGroup">
        @foreach( $apis_info as $group )

            <article class="group">

                <div class="details">
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

                    @foreach( $apiRequestsDates_info as $requestsDates )
                        @if( $requestsDates->api == $group->id_api )
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