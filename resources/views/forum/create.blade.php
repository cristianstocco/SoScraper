@extends( 'layouts.app' )

@section( 'content' )
    <form action="{{ route('forum.store') }}" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="title" name="title" class="form-control" placeholder="Title">
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <textarea class="form-control" name="message" placeholder="Message"></textarea>
        </div>
        
        <div class="form-group">
            <label for="exampleInputFile">Section</label>
            <select name="section">
                @foreach( $sections as $section )
                    <option value="{{ strtolower( $section[ 'name' ] ) }}">{{ $section[ 'name' ] }}</option>
                @endforeach
            </select>
        </div>
        
        {{ csrf_field() }}
        <input type="submit" class="btn btn-default" name="submit" value="Submit" />
    </form>
@endsection