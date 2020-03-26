@extends( 'layouts.app' )

@section( 'content' )
    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        Forum - Topic
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Title</div>
        <div class="col-xs-8">{{ $topic[ 'title' ] }}</div>
    </div>

    <div class="row paragraph">
        <div class="col-xs-4">Message</div>
        <div class="col-xs-8">{{ $topic[ 'message' ] }}</div>
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
    <div class="paragraph"></div>
    
    @if( is_array( $comments ) )
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $comments as $comment )
                    <tr>
                        <td>{{ $comment[ 'author' ] }}</td>
                        <td>{{ $comment[ 'message' ] }}</td>
                        <td>{{ $comment[ 'created_at' ] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <div class="paragraph"></div>
    <div class="paragraph"></div>
    <div class="paragraph"></div>

    <a class="btn btn-primary" href="{{ $topic[ 'route' ] }}">Comment</a>
@endsection