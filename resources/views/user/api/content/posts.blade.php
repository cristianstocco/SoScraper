@extends( 'user.api.content._content' )

@section( 'partial' )
    <ul class="choose_partial">

    @foreach( $responseData as $content )
        @if( isset($content['cover_photo']) && isset($content['cover_photo']['source']) )
            <li class="box_chooses" style="background-image: url( '{{ $content['cover_photo']['source'] }}' )">
        @else
            <li class="box_chooses">
        @endif
 
            <a>
                <div class="text_desc">
                    @if( isset($content['message']) )
                        <p class="  ">
                            {{ $content['message'] }}
                        </p>
                    @endif

                    @if( isset($content['source']) )

                        <p class="">
                            {{ $content['source'] }}
                        </p>
                    @endif
                </div>
            </a>

            <input type="checkbox" name="{{ $content['userLink'] }}" value="1">
        </li>
    @endforeach
    </ul>
@endsection