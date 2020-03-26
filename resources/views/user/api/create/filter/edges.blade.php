@extends( 'layouts.app' )

@section( 'content' )
<main class="news source">
    <section class="top">
        <div class="content">
            <h1>New FULL API </h1>
            <p>TO ADD TO YOUR RESPONSE API.</p>

         </div>
    </section>
    <div class="content">
        <div id="sources">
            <form action="{{ route( 'api.createSettingsPOST' ) }}" method="POST" accept-charset="utf-8" id="chooses_form">
                {{ csrf_field() }}
                <div class="contact_form">
                <span>STEP 2</span>
                    <h4>CHOOSE MEDIA</h4>

                    @if( session( 'status' ) )
                        <div class="error">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                    @if( session( 'status' ) )
                        <div class="error">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                    @foreach( $edges as $edge )
                        <li class="box_source" data-scelta="">
                            <p class="">
                                {{ $edge->title }}
                            </p>
                            <input type="checkbox" name="content" value="{{ $edge->endPath }}">

                            <nav class="sub"></nav>
                        </li>
                    @endforeach
                    </ul>

                    <input id="full_api_submit" type="submit" name="submit" id="next" value="SET FULL">

            </form>
            <div class="contact_form" id="chooses">
               
            </div>

        </div>
    </div>
</main>
@endsection

@section( 'overlay' )
    <div id="overlay">
        <header>
            <a href="#">
                ( X )
            </a>
        </header>

        <section class="content"></section>
    </div>
@endsection
