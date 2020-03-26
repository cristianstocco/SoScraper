@extends( 'layouts.app' )

@section( 'content' )

    <div class="general-title">
        Social Crawler
    </div>

    <div class="general-description">
        Forum
    </div>

    <div>
        Welcome to the forum section. Here you can post any topic about the forum in order to receive any type of assistance.
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Section Name</th>
                    <th>Description</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $sections as $section )
                    <tr>
                        <th>
                            <a href="{{ route( $section['routeName'] ) }}">{{ $section[ 'name' ] }}</a>
                        </th>
                        <th>{{ $section[ 'description' ] }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection