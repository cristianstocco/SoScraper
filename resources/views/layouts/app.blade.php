<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body id="app-layout" class="{{ $bodyClasses }}">
    {{-- Navigation --}}
    <header id="mast_head">
        <div class="content_header">
            <div id="logo">
                <h1><a href="/">SOCRAWLER</a></h1>
            </div>

            @include( 'partials.menu' )

        </div>
    </header>

    @yield('content')

    @include( 'partials.overlay' )

    <!-- JavaScripts -->
    @yield( 'scripts' )

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="/js/jquery-2.1.4.js"><\/script>');
        }
    </script>
    <script src="/js/application.min.js"></script>
    <script type="text/javascript">
        // INCLUDO FONT
        WebFontConfig = {
            google: { families: [ 'Lato:300,400,700,900'] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
        // INCLUDO analitycs

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-00000000-0', 'auto');
        ga('send', 'pageview');
        </script>
</body>
</html>
