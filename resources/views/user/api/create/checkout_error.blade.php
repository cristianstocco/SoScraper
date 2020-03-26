@extends( 'layouts.app' )

@section( 'content' )
    
 <main id="news" class="content">

    <section class="success_api">

        <div class="box_shadoow">
            <i class="icon-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="108" height="108" viewBox="0 0 108 108"><style>.st0{fill:#F17959;}</style><path class="st0" d="M54 108c29.8 0 54-24.2 54-54S83.8 0 54 0 0 24.2 0 54s24.2 54 54 54zm0-6.5c-12.1 0-23.1-4.6-31.5-12l67-67c7.5 8.4 12 19.4 12 31.5 0 26.2-21.3 47.5-47.5 47.5zm0-95c11.8 0 22.5 4.3 30.8 11.4L17.9 84.8C10.8 76.5 6.5 65.8 6.5 54 6.5 27.8 27.8 6.5 54 6.5zm0 0"/></svg>
            </i>
            <div class="text_success rosso">
        CHECKOUT WAS REFUSED BY PAYPAL

            </div>
            <p>
        Your payment was being refused by PayPal through the payment execution.
        Please try again or later.
            </p>
            
            <a id="checkout" class="button_call" href="{{ route('dashboard') }}"><span class="text-button">dashboard</span><span class="gradient"></span></a>
        </div>
    </section>
    </main>
@endsection