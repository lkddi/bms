<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="js/jquery.min.js"></script>

    <script type="text/javascript" src="js/picbox.js"></script>

    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .table th, .table td {
            text-align: center;
            /*height:38px;*/
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                @guest  <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{config('app.name')}}
                    </a>
                </div>


                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                            零售控价系统
                        </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar --><ul class="nav navbar-nav">
                        @if(auth()->user()->gid=== 8)
                        <li @if (Request::is('/sale*')) class="active" @endif>
                            <a href="/sale">所有数据</a>
                        </li>
                        @endif
                            <li @if (Request::is('/cxby*')) class="active" @endif>
                            <a href="/cxby">本月数据</a>
                        </li>
                        <li @if (Request::is('/cxbz*')) class="active" @endif>
                            <a href="/cxbz">本周数据</a>
                        </li>
                        <li @if (Request::is('/zhengce*')) class="active" @endif>
                            <a href="/zhengce">活动维护</a>
                        </li>
                        <li @if (Request::is('/mode*')) class="active" @endif>
                            <a href="/mode">产品维护</a>
                        </li>
                        <li @if (Request::is('/mendian*')) class="active" @endif>
                            <a href="/mendian">门店管理</a>
                        </li>
                        <li @if (Request::is('/qudao*')) class="active" @endif>
                            <a href="/qudao">渠道管理</a>
                        </li>
                        <li @if (Request::is('/cxbz*')) class="active" @endif>
                            <a href="/cxbz">个人设置</a>
                        </li>

                    </ul>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">登陆</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            退出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
