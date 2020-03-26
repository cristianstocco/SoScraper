@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
                <h1>Review for payment</h1>
                @if( App\User::isAdmin() || App\User::isModerator() )
                    <p class="">
                        (= You are the administrator or a moderator, so you are being excluded from payment! =)
                    </p>
                @endif

         </div>
    </section>

    <div class="content">
        @if( session( 'status' ) )
            <p class="error">
                {{ session('status') }}
            </p>
        @endif

        <form action="{{ $nextStepFlow }}" accept-charset="utf-8" method="POST">
            {{ csrf_field() }}

            <ul class="list_amount">

                <li>
                    <div class="title">Mode</div> -  <span class="text_big">{{ $mode }}</span>

                </li>
                <li><div class="title">API NUMBER</div> <span class="text_big">{{ $apiNumber }}</span></li>
                <li>
                    <div class="title">API RATES</div>
                    <ul>
                        @foreach( $apiRates as $rate )

                        <li class="fake_check">

                            <input type="checkbox" name="service_number" value="{{ $rate['servicesNo'] }}">
                            <label for="service_number">Services number: {{ $rate['servicesNo'] }} - Cost: {{ $rate['monthCost'] }} / month</label>

                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <div class="title">Month Payment</div>
                    <div class="range">
                          <input name="month_payment" class="range-slider" type="range" min="1" max="12">

                        </div>
                </li>
                <li>
                <div class="title">Month discount</div>
                    <ul>
                        @foreach( $monthDiscounts as $discount )
                            <li>
                                Up to month number: {{ $discount['monthNo'] }} - Discount: {{ $discount['discount%'] }}%
                            </li>
                        @endforeach
                    </ul>

                </li>
            </ul>
                <input type="submit" name="create"  id="next" value="Create APIs">
        </form>
    </div>

</main>
@endsection
