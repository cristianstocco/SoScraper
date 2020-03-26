@extends( 'layouts.app' )

@section( 'content' )

<main class="news">
    <section class="top">
        <div class="content">
            <h1>API show</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quaerat consequatur obcaecati optio cupiditate, temporibus sit aperiam, quod eveniet tempora. Aspernatur eaque exercitationem beatae eligendi porro libero qui, nesciunt quibusdam.
            </p>
         </div>
    </section>

        @include( 'user.api.show._info' )
        @include( 'user.api.show._partial' )
        @include( 'user.api.show._full' )

</main>

@endsection