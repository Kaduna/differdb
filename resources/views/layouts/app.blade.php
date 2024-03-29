<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ url('/img/logo_small.png') }}" />

    <title>Differ</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/default.min.css">
    <link href="{{ url('/css/vex.css') }}" rel="stylesheet">
    <link href="{{ url('/css/vex-theme-default.css') }}" rel="stylesheet">
    <link href="{{ url('/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ url('/css/jquery.treegrid.css') }}" rel="stylesheet">
    <link href="{{ url('/css/icheck/grey.css') }}" rel="stylesheet">
    <link href="{{ url('/css/main.css') }}" rel="stylesheet">
    <link href="{{ url('/css/selectize.css') }}" rel="stylesheet">
    <link href="{{ url('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link href="{{ url('/css/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Differ
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (!Auth::guest())
                        <li><a href="{{ url('/databases') }}"><i class="fa fa-list"></i> Databases</a></li>
                        <li><a href="{{ url('/diff/create') }}"><i class="fa fa-database"></i> Structure Diff</a></li>
                    @endif
                    <li><a href="{{ url('/faq') }}"><i class="fa fa-question-circle"></i> FAQ</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script>
    <script src="{{ url('/js/ajax-form.js') }}"></script>
    <script src="{{ url('/js/vex.combined.min.js') }}"></script>
    <script src="{{ url('/js/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ url('/js/jquery.treegrid.min.js') }}"></script>
    <script src="{{ url('/js/jquery.treegrid.bootstrap3.js') }}"></script>
    <script src="{{ url('/js/icheck/icheck.min.js') }}"></script>
    <script src="{{ url('/js/clipboard.min.js') }}"></script>
    <script src="{{ url('/js/selectize.min.js') }}"></script>
    <script src="{{ url('/js/ladda/spin.min.js') }}"></script>
    <script src="{{ url('/js/ladda/ladda.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js"></script>

    <script>
        var host = "{{URL::to('/')}}";
        var csrf_token = "{{ csrf_token() }}";
    </script>

    <script src="{{ url('/js/main.js') }}"></script>

    @yield('javascript')

</body>
</html>
