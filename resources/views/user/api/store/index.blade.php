@extends( 'layouts.app' )

@section( 'content' )
<main id="news" class="content">
    <section class="success_api">

        <div class="box_shadoow">
            <i class="icon-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="104.3" height="67.1" viewBox="0 0 104.3 67.1"><style>.st0{fill:#43CEA2;}</style><path class="st0" d="M101.7 3.4c-3.8-4.2-10.2-4.5-14.4-.7L42.2 43.4l-25-23.7c-4.1-3.9-10.5-3.7-14.4.4-3.9 4.1-3.7 10.6.4 14.4l31.4 29.8c2 1.9 4.5 2.8 7 2.8 1.4 0 2.8-.3 4.2-.9 1.5-.4 3-1.2 4.2-2.3l51-46.2c4.2-3.7 4.5-10.2.7-14.3zm0 0"/></svg>
            </i>
            <div class="text_success verde">
                    You have successfully created every APIs.
            </div>
            <p>
               Your payment was successfully done. </br>
                Transaction ID: {{ $paymentID }}</br>
                Total: {{ $total }}
            </p>
            
            <a id="checkout" class="button_call" href="{{ route('dashboard') }}"><span class="text-button">dashboard</span><span class="gradient"></span></a>
        </div>
    </section>
</main>
@endsection