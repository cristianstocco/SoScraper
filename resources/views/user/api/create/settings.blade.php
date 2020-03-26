@extends( 'layouts.app' )

@section( 'content' )
<main class="news">
    <section class="top">
        <div class="content">
                <h1> Set settings for APIs.</h1>
                <p>Facebook Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum....</p>

         </div>
    </section>
    <div class="content">
            <div id="sources">
        @if( session( 'status' ) )
            <p class="error">
                {{ session('status') }}
            </p>
        @endif

        <form action="{{ route( 'api.review' ) }}" accept-charset="utf-8" method="POST" id="white_list">
            {{ csrf_field() }}
            <div class="contact_form">
            <span>Step 3</span>

                <div class="general-title"><label for="whiteListDomain">White List Domain</label>
                <input type="text"  class="border" name="whiteListDomain" id="whiteListDomain" value="">
                </div>
                <div class="general-title"><label for="whiteListDomain">White List Staging IP</label>
                <input type="text"  class="border" name="whiteListStagingIP" id="whiteListStagingIP" value="">
                </div>

            </div>

            <div class="fake_check">
                <input type="checkbox" class="border" name="noWhiteList" id="noWhiteList" value="">
                <label for="noWhiteList">No whitelist domain</label>

            </div>
            <div class="description">
                <p>
                Remember that if you choose to insert no whitelist domain or IP,
                the submitted APIs will be cancelled in 7days (30 days for premium account).
                </p>
            </div>
            <input type="submit" name="create" value="Create APIs" id="next">

        </form>
    </div>

@endsection