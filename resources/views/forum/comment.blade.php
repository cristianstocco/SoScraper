@extends( 'layouts.app' )

@section( 'content' )
    <div class="general-description">
        Topic.
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Title</div>
        <div class="col-xs-8">{{ $topic[ 'title' ] }}</div>
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Message</div>
        <div class="col-xs-8"><textarea class="form-control" readonly="readonly">{{ $topic[ 'message' ] }}</textarea></div>
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Author</div>
        <div class="col-xs-8">{{ $topic[ 'author' ] }}</div>
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Created At</div>
        <div class="col-xs-8">{{ $topic[ 'created_at' ] }}</div>
    </div>

    <div class="paragraph"></div>
    <div class="paragraph"></div>

    <form action="{{ route('forum.commentStore') }}" method="POST">
        <div class="form-group">
            <label for="exampleInputPassword1">Comment Message.</label>
            <textarea class="form-control" name="message" placeholder="Message"></textarea>
        </div>
        
        {{ csrf_field() }}
        <input type="submit" class="btn btn-default" name="submit" value="Submit" />
    </form>
@endsection