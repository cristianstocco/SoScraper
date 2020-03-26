@extends( 'layouts.app' )

@section( 'content' )
<main class="statistics">
    <section class="top">
        <div class="content">
            <h1>APIs Statistics</h1>
        </div>
    </section>


    <div class="l-chart">
        <div class="aspect-ratio">
            <canvas id="chart" data-id="{{ $id }}"></canvas>
        </div>
    </div>
</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
@endsection