@extends( 'layouts.app' )

@section( 'content' )

    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        Coding
    </div>

    <div class="paragraph">
        <div><b>Info Api</b></div>
        
        The prices and Api numbers which could be implemented are:
        
        @foreach( $infoApis as $api )
            <div>
                Cost: {{ $api[ 'monthCost' ] }}
            </div>
            <div class="paragraph">
                Service number: {{ $api[ 'servicesNo' ] }}
            </div>
        @endforeach
    </div>

    <div class="paragraph">
        <div><b>Media Api</b></div>
        
        The prices and Api numbers which could be implemented are:
        
        @foreach( $mediaApis as $api )
            <div>
                Cost: {{ $api[ 'monthCost' ] }}
            </div>
            <div class="paragraph">
                Service number: {{ $api[ 'servicesNo' ] }}
            </div>
        @endforeach
    </div>

@endsection