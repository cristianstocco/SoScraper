<form id="select_chooses" action="{{ route('api.createPartial') }}" method="POST">
    {{ csrf_field() }}

    @if( isset($responseData) )
        <section id="media">
            @yield( 'partial' )

            <div style="clear: both;" ></div>
        </section>
    @endif
    <ul >
        @foreach( $edgeNodes as $node )
            <li class="fake_check">
                <input type="checkbox" name="{{ $node->userLink }}" value="1">

                <label for="{{ $node->userLink }}">{{ $node->title }}</label>

                <p>{{ $node->description }}</p>
            </li>
        @endforeach
    </ul>

        <input type="submit" name="submit" value="Set partial API">
</form>