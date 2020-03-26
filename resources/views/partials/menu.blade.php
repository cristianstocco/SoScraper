<ul id="menu">
    @if( isset($menuActive) && $menuActive == 'home' )
        <li class="active"><a href="/">Home</a></li>
    @else
        <li><a href="/">Home</a></li>
    @endif

    @if( isset($menuActive) && $menuActive == 'news' )
        <li class="active"><a href="/news">News</a></li>
    @else
        <li><a href="/news">News</a></li>
    @endif

    @if( isset($menuActive) && $menuActive == 'doc' )
        <li class="active"><a href="/documentation">Documentation</a></li>
    @else
        <li><a href="/documentation">Documentation</a></li>
    @endif

    @if( Auth::user() )
        <li class="has_submenu"><a class="login" href="/dashboard">{{ Auth::user()->username }} <span class="img_admin"><img src="/img/admin.svg" alt=""></span></a>
            <ul class="sub-menu">

                @if( isset($menuActive) && $menuActive == 'dashboard' )
                    <li class="active"><a href="/dashboard">Dashboard</a></li>
                @else
                    <li><a href="/dashboard">Dashboard</a></li>
                @endif

                <li><a href="/logout">Logout</a></li>
            </ul>
        </li>
    @elseif( isset($menuActive) && $menuActive == 'login' )
        <li class="active"><a href="/login">Login</a></li>
    @else
        <li><a href="/login">Login</a></li>
    @endif
</ul>
<div class="toggle_menu"><span></span></div>
