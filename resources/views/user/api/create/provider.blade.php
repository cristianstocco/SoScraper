@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
                <h1>Select your provider.</h1>
                <p>Facebook...</p>

         </div>
    </section>
    <div class="content">
        <div id="providers">
            @if( !is_null( session('status') ) )
                <div class="error">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route( 'api.createSourcePOST' ) }}" accept-charset="utf-8" method="POST">
                {{ csrf_field() }}

                @foreach( $providers as $provider )
                    <article class="provider">
                        <input type="radio" name="provider" value="{{ $provider->name }}" style="display: none" />
                        {{ $provider->name }}
                    </article>
                @endforeach

                <input type="submit" name="submit" value="Submit" style="display: none">
            </form>
        </div>
    </div>

</main>
@stop

@section( 'scripts' )
    <script type="text/javascript" src="/js/app.js" ></script>
@stop