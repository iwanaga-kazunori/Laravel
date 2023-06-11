<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="api-token" content="{{ $user->api_token }}">
<meta name="user_id" content="{{ $user->id }}">

<!-- Scripts -->
<script src="{{ asset('js/feed.js') }}" defer></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    
<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/base.css') }}" rel="stylesheet">
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<link href="{{ asset('css/feed.css') }}" rel="stylesheet">
<link href="{{ asset('css/matches.css') }}" rel="stylesheet">
<link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
<link href="{{ asset('css/sns.css') }}" rel="stylesheet">

<title>@yield('title')</title>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
    <loading-component></loading-component>
    <div class="menu">
        <input id="tab01" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab01">マイページ</label>
        <div class="tab-content">
            <mypage-component :user='@json($user)' :fateams='@json($fateams)'></mypage-component>
        </div>
        <input id="tab02" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab02">新着情報</label>
        <div class="tab-content">
            <feed-list></feed-list>
        </div>
        <input id="tab03" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab03">試合結果・日程</label>
        <div class="tab-content">
            <matches-component></matches-component>
        </div>
        <input id="tab04" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab04">SNSまとめ</label>
        <div class="tab-content">
            <div class="container sns">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-10">
                        <h3>Bundesliga日本公式</h3>
                        <div class="sns-box">
                            <a class="twitter-timeline" href="https://twitter.com/Bundesliga_JP?ref_src=twsrc%5Etfw">Tweets by Bundesliga_JP</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-10">
                        <h3>Bundesligaドイツ公式</h3>
                        <div class="sns-box">
                            <a class="twitter-timeline" href="https://twitter.com/Bundesliga_DE?ref_src=twsrc%5Etfw">Tweets by Bundesliga_DE</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-10">
                        <h3>Fcバイエルン公式</h3>
                        <div class="sns-box">
                            <a class="twitter-timeline" href="https://twitter.com/FCBayern?ref_src=twsrc%5Etfw">Tweets by FCBayern</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-10">
                        <h3>Fcケルン公式</h3>
                        <div class="sns-box">
                            <a class="twitter-timeline" href="https://twitter.com/fckoeln?ref_src=twsrc%5Etfw">Tweets by fckoeln</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <input id="tab01" type="radio" name="" class="tab-switch"><label class="tab-label" for="tab01">マイページ</label>
            <input id="tab02" type="radio" name="" class="tab-switch"><label class="tab-label" for="tab02">新着情報</label>
            <input id="tab03" type="radio" name="" class="tab-switch"><label class="tab-label" for="tab03">試合結果・日程</label>
            <input id="tab04" type="radio" name="" class="tab-switch"><label class="tab-label" for="tab04">SNSまとめ</label>
        </div>
    </footer>
</div>
</body>
</html>
