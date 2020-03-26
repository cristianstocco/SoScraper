@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
                <h1>NEW API </h1>
                <p>Facebook Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum....</p>

         </div>
    </section>
    <div class="content">
            <div id="sources">
                <form action="{{ route( 'api.createHubFilter' ) }}" accept-charset="utf-8" method="POST">
                    {{ csrf_field() }}
                    <div class="contact_form">

                        <span>STEP 2</span>
                        <h4>CHOOSE MEDIA</h4>

                        @if( session( 'status' ) )
                            <div class="error">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-text">
                            <input type="text" name="source" value="{{ $source }}">
                            <label for="source" class="static-value">www.facebook.com/</label>
                        </div>
                    </div>
                    <ul>
                        <li class="box_labeling" data-scelta="scelta-full">
                            <label for="full">full</label>
                            <input type="radio" name="mode" value="full" id="full">
                        </li>
                        <li class="box_labeling" data-scelta="scelta-info">
                            <label for="full">Info</label>

                            <input type="radio" name="mode" value="info" id="info">
                        </li>
                        <li class="box_labeling" data-scelta="scelta-partial">
                            <label for="full">partial</label>

                            <input type="radio" name="mode" value="partial" id="partial">
                        </li>
                    </ul>

  
                   
                    <div class="description" id="scelta-full">
                        <p>
                            Hover on Full e descizione del servizio, consectetur adipiscing elit. Phasellus in lorem ac neque efficitur viverra. Nunc ornare quam vitae felis sagittis efficitur et a nisi. Nullam luctus varius urna, quis cursus lectus vestibulum varius. Vestibulum pretium in urna sit amet placerat. Nunc scelerisque lacus eu nibh rutrum imperdiet.
                        </p>
                    </div>
                    <div class="description" id="scelta-info" style="display: none;">>
                        <p>
                            Hover on Full e descizione del servizio, consectetur adipiscing elit. Phasellus in lorem ac neque efficitur viverra. Nunc ornare quam vitae felis sagittis efficitur et a nisi. Nullam luctus varius urna, quis cursus lectus vestibulum varius. Vestibulum pretium in urna sit amet placerat. Nunc scelerisque lacus eu nibh rutrum imperdiet.
                        </p>
                    </div>
                    <div class="description" id="scelta-partial" style="display: none;">>
                        <p>
                            Hover on Full e descizione del servizio, consectetur adipiscing elit. Phasellus in lorem ac neque efficitur viverra. Nunc ornare quam vitae felis sagittis efficitur et a nisi. Nullam luctus varius urna, quis cursus lectus vestibulum varius. Vestibulum pretium in urna sit amet placerat. Nunc scelerisque lacus eu nibh rutrum imperdiet.
                        </p>
                    </div>
                        

                          
                        <input type="submit" name="submit" value="Next" id="next">
                </form>
            </div>

        </div> 

    </div>
</main>
@endsection