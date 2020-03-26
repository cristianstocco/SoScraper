@extends( 'layouts.app' )

@section( 'content' )
    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        Forum - Feature
    </div>

    <div class="paragraph">
        <a href="{{ route( 'forum.create' ) }}" class="btn btn-primary">Create Topic</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Author</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $topics as $topic )
                    <tr>
                        <th>
                            <a href="{{ route( $topic[ 'ID' ] ) }}">{{ $topic[ 'title' ] }}</a>
                        </th>
                        <th>{{ $topic[ 'message' ] }}</th>
                        <th>{{ $topic[ 'author' ] }}</th>
                        <th>{{ $topic[ 'created_at' ] }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection