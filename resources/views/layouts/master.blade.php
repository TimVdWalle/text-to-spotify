<!-- Stored in resources/views/layouts/master.blade.php -->

{{--<html>--}}
{{--<head>--}}
{{--    <title>App Name - </title>--}}
{{--</head>--}}
{{--<body>--}}
{{--@section('sidebar')--}}
{{--    This is the master sidebar.--}}
{{--@show--}}

{{--<div class="container">--}}
{{--    --}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}



<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link href='//fonts.googleapis.com/css?family=Lato:400,900,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mediaqueries.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/colors/purple.css">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <!-- Javascript
  ================================================== -->
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/jquery.equalHeights.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/hyphenator.js"></script>
{{--    <script src="jwplayer/jwplayer.js"></script>--}}
    <script src="js/scripts.js"></script>
    <script src="//maps.google.com/maps/api/js?sensor=false"></script>

    <script src="js/modernizr.js"></script>
    @vite('resources/js/app.js')

</head>

<div id="wrap">
    <div class="container">

        <!-- ########################### HEADER ########################### -->
        <header id="header" class="group">
            <h1 id="logo" class="four columns">
                <a href="/">
{{--                    <img src="images/logo.png" alt="" />--}}
                    <i class="fa-solid fa-music"></i>
                </a></h1>
            <nav id="nav" class="nav twelve columns">
                <ul id="navigation" class="sf-menu">
                    <li>
                        <a href="/">Home</a>
{{--                        <ul>--}}
{{--                            <li><a href="index.html">Normal</a></li>--}}
{{--                            <li><a href="index_alt.html">Alternative</a></li>--}}
{{--                        </ul>--}}
                    </li>
                    <li>
                        <a href="/about">About</a>
{{--                        <ul>--}}
{{--                            <li><a href="discography_3col.html">Discography 3 Cols</a></li>--}}
{{--                            <li><a href="discography_4col.html">Discography 4 Cols</a></li>--}}
{{--                            <li><a href="album.html">Album template</a></li>--}}
{{--                            <li><a href="album_reversed.html">Album reversed</a></li>--}}
{{--                        </ul>--}}
                    </li>
{{--                    <li>--}}
{{--                        <a href="#">Media layouts</a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="galleries_3col.html">Galleries 3 Cols</a></li>--}}
{{--                            <li><a href="galleries_4col.html">Galleries 4 Cols</a></li>--}}
{{--                            <li><a href="gallery_3col.html">Gallery 3 Cols</a></li>--}}
{{--                            <li><a href="gallery_4col.html">Gallery 4 Cols</a></li>--}}
{{--                            <li><a href="videos_3col.html">Videos 3 Cols</a></li>--}}
{{--                            <li><a href="videos_4col.html">Videos 4 Cols</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">Blog layouts</a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="blog1.html">Blog 1 sidebar</a></li>--}}
{{--                            <li><a href="single.html">Post 1 sidebar</a></li>--}}
{{--                            <li><a href="blog2.html">Blog 2 sidebars</a></li>--}}
{{--                            <li><a href="single_alt.html">Post 2 sidebars</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="fullwidth.html">Fullwidth</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="events.html">Events</a>--}}
{{--                    </li>--}}
                </ul><!-- /navigation -->
            </nav><!-- /nav -->
        </header><!-- /header -->
        <!-- ########################### MAIN ########################### -->

        <h3 class="section-title">@yield('title')</h3>

        <div class="row">
            <div class="sixteen columns">

                @yield('content')

            </div><!-- /sixteen columns -->
        </div><!-- /row -->

    </div><!-- /container -->

    <!-- ########################### FOOTER ########################### -->
    <div id="footer-wrap">
        <div class="container">

            <footer id="footer" class="sixteen columns">
                <div class="twelve columns offset-by-four">
                    © {{now()->year}} text-to-spotify | All rights reserved | This site uses Spotify API <i class="fa-brands fa-spotify" style="color: #1DB954;"></i>
                </div>
            </footer><!-- /footer -->

        </div><!-- /container -->
    </div><!-- /footer-wrap -->

</div><!-- /wrap -->

</body>
</html>
