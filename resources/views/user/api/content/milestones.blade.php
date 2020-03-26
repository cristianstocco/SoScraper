@extends( 'user.api.content._content' )

@section( 'partial' )
    @foreach( $responseData as $content )
        @if( isset($content['cover_photo']['source']) )
            <article style="background: url( '{{ $content['cover_photo']['source'] }}' ) no-repeat">
        @else
            <article>
        @endif

            @if( isset($content['title']) )
                <p class="title">
                    {{ $content['title'] }}
                </p>
            @endif

            @if( isset($content['description']) )
                <p class="description">
                    {{ $content['description'] }}
                </p>
            @endif

            <input type="checkbox" name="{{ $content['userLink'] }}" value="1">
        </article>
    @endforeach
@endsection