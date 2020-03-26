@extends( 'layouts.app' )

@section( 'content' )

    <div id="modes">
        <form action="{{ route( 'api.createHubFilter' ) }}" accept-charset="utf-8" method="POST">
            {{ csrf_field() }}

            <div class="general-title">Choose the mode of your API.</div>

            @foreach( $api_modes as $mode )
                <article>
                    <label for="{{ $mode->name }}">{{ $mode->name }}</label>

                    <input type="radio" name="mode" value="{{ $mode->name }}" id="{{ $mode->name }}">

                    <p>
                        {{ $mode->description }}
                    </p>
                </article>
            @endforeach

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

@stop

@section( 'scripts' )
    <script type="text/javascript" src="/js/app.js" ></script>
@stop