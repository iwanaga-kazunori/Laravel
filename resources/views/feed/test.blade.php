<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/test.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/base.css') }}" rel="stylesheet">
        <style>
            
        </style>
    </head>
    <body>
        <div id="app">
            <header class="py-4" style="z-index:-9999;">
                {{-- 画面上部に表示するナビゲーションバーです。 --}}
                <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->nickname }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            {{-- ここまでナビゲーションバー --}}
            <div>
                <form method="POST" action="{{route('test.update')}}">
                    @csrf
                    <input name="name" />
                    <button>更新する</button>
                </form>
                <div v-show="checkflg">チェックが入るとこの要素が表示されます</div>
                <input type="checkbox" v-model="checkflg" /> チェックを入れる
            </div>
            <div>
                <div class="form">
                    <input type="number" value="1" id="num1" />
                        +
                    <input type="number" value="2" id="num2" /> =
                    <span id="result"></span>
                </div>
                <div class="action">
                    <button id="buttonExecute">計算</button>
                </div>
            </div>
            <example-component v-bind:favoriteteams='@json($favoriteteams)'></example-component>
            <footer class="py-4" style="background-color:#888;clear:both;">
            </footer>
        </div>
    </body>
</html>