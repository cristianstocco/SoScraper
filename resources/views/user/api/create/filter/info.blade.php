@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
            <h1>NEW API </h1>
            <p> Choose the media to add to your response API.</p>

         </div>
    </section>
    <div class="content">
        <div id="sources">

            <form id="select_chooses" action="{{ route( 'api.createSettingsPOST' ) }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                <div class="contact_form">

                    <span>STEP 2</span>
                    <h4>>CHOOSE FIELDS</h4>

                    @if( session( 'status' ) )
                        <div class="error">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <ul class="checkbox">
                @foreach( $infos as $info )
                    <li class="fake_check">
                            
                        <input type="checkbox" name="{{ $info->inputName }}" value="{{ $info->query }}">
                        <label for="{{ $info->inputName }}">{{ $info->query }}</label>


                        <p class="">
                            {{ $info->description }}
                        </p>
                    </li>
                @endforeach
                </ul>
                <input type="submit" name="submit" id="next" value="Set full">
            </form>
        </div>
    </div>
</main>
@endsection