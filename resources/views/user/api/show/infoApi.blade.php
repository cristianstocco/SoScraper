@extends( 'layouts.app' )

@section( 'content' )

    <section id="sub-apiGroup">
        <div class="general-title">Your details about APIs are the following:</div>

        <div class="key">Key: {{ $apiResource->basePathKey }}</div>
        <div class="url">URL: <a href="http://api.agileapis.it/{{ $apiResource->basePathKey }}" target="_blank">http://api.agileapis.it/{{ $apiResource->basePathKey }}</a></div>
    </section>

@endsection