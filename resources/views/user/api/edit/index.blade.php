    <h3 class="general-title">Editing api</h3>
    <div class="info_api">
        <span>
            Key: {{ $apiResource->basePathKey }}
        </span>
        <span>
            URL: <a href="http://api.agileapis.ideoplayground.com/{{ $apiResource->basePathKey }}" target="_blank">http://api.agileapis.ideoplayground.com/{{ $apiResource->basePathKey }}
        </span>
    </div>

    <div class="key"></div>

    <form action="{{ route( 'api.update' ) }}" method="POST" id="edit_api">
        {{ csrf_field() }}

        @if( session( 'status' ) )
            <div class="error">
                {{ session( 'status' ) }}
            </div>
        @endif
        <div class="col2">
            <label for="whiteListDomain">Whitelist domain:</label>
            <input type="text" name="whiteListDomain" value="{{ $apiResource->whiteListDomain }}">
        </div>
        <div class="col2">
            <label for="whiteListStagingIP">Whitelist staging IP:</label>
            
            <input type="text" name="whiteListStagingIP" value="{{ $apiResource->whiteListStagingIP }}">
        </div>
        @if( !is_null($apiResource->missingDaysToWhiteList) )
        <div class="col_full">
        <input type="checkbox" name="noWhiteList" id="noWhiteList"
               @if( $apiResource->whiteListDomain == "" && $apiResource->whiteListStagingIP == "" )
                   checked="checked"
               @endif
               >
            <label for="noWhiteList">No whitelist domain</label>

        </div>

        @endif

        <input type="submit" name="update" value="update">
    </form>
