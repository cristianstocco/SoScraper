@extends( 'layouts.app' )

@section( 'content' )

    <div id="schedulers">

        <div class="general-title">
            Choose the refresh period for every edge choosen.
        </div>

        <form action="{{ route( 'api.createSettingsPOST' ) }}" accept-charset="utf-8" method="POST">
            {{ csrf_field() }}

            @foreach( $apis as $api )
                <div class="edge">
                    <div class="title">
                        {{ $api[ 'edge' ] }}
                    </div>

                    @foreach( $schedule_versions as $version )

                        <div class="scheduler">
                            <div class="description">
                                {{ $version->description }}
                            </div>
                            <input type="radio" name="schedule_{{ $api[ 'key' ] }}" value="{{ $version->key }}">
                        </div>

                    @endforeach
                    
                    <div style="clear: both;"></div>
                </div>
            @endforeach

            <input type="submit" name="submit" value="Submit">
        </form>

    </div>

@stop