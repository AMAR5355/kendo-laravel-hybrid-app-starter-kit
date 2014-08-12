<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- CSS -->
    {{ Casset::add('less/style.less') }}
    {{ Casset::add('css/jquery-ui-1.10.4.custom.css') }}
    {{ Casset::add('less/slides.less') }}
    {{ Casset::container('default')->styles() }}

    <!-- SEO Properties -->
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="canonical" href="{{{ URL::full() }}}" />
</head>
<body>

    <div id="header">
        <div class="topbar">
            <div class="wrapper">
                <div class="topNav">
                    <ul>
                        <li><a href="{{{ URL::to('members/dashboard') }}}">My Account</a></li>
                        <li><a href="{{{ URL::to('login') }}}">Sign In</a></li>
                        <li><a href="{{{ URL::to('register') }}}">Register</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="wrapper">
            <a href="/index.php"><img src="/images/logo.png" width="220" height="70" alt="Starter Site" id="logo" /></a>

            <div class="col6 right">
                <ul class="mainNav">
                    <li><a href="{{{ URL::to('') }}}"  class="" >HOME</a></li>
                    <li><a href="{{{ URL::to('about') }}}"  class="" >ABOUT</a></li>
                    <li><a href="{{{ URL::to('styles') }}}"  class="" >STYLES</a></li>
                    <li><a href="{{{ URL::to('contact-us') }}}"  class="active" >CONTACT</a></li>
                    <li style="clear:both;"></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div> <!-- header -->
    {{--
    <ul class="navigation">
        @section('navigation')
            <li>Example Item 1</li>
            <li>Example Item 2</li>
            @unless(Sentry::check())
                <li>Login</li>
            @endunless
        @endsection
    </ul>
    --}}

    <div class="wrapper" id="content">
        @yield('content')
    </div>
    <br class="clear" />


    <div class="footer">
        <div class="wrapper">
            <div class="col3">
                <ul class="footer-links">
                    <li><h4>COMPMANY</h4></li>
                    <li><a href="{{{ URL::to('about') }}}">About Us</a></li>
                    <li><a href="{{{ URL::to('contact-us') }}}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col3">
                <ul class="footer-links">
                    <li><h4>INFORMATION</h4></li>
                    <li><a href="{{{ URL::to('privacy') }}}">Privacy</a></li>
                    <li><a href="{{{ URL::to('terms') }}}">Terms of Use</a></li>
                </ul>
            </div>

            <div class="col3" >
                <h4 class="title">FOLLOW US:</h4>
                <a href=""><img src="/images/media-fb.png" /></a>
                <a href=""><img src="/images/media-twitter.png" /></a>
            </div>

            <div class="col3">
                <p class="credit">Copyright &copy; Starter Site {{{ date('Y') }}} </p>
            </div>
            <div class="clear"></div>
        </div> <!-- wrapper -->

    </div> <!-- footer -->

    <!-- Javascript -->
    {{ Casset::add('js/jquery-1.11.0.js') }}
    {{ Casset::add('js/jquery-ui-1.10.4.js') }}
    {{ Casset::add('js/jquery.validate.js') }}
    {{ Casset::add('js/jquery.ui.timepicker.js') }}
    {{ Casset::container('default')->scripts() }}

    <script type="text/javascript">
        jQuery.noConflict();
        var FULLURL = '{{{ URL::to('') }}}';
        var BASEURL = '{{{ URL::to('') }}}';
    </script>
</body>
</html>