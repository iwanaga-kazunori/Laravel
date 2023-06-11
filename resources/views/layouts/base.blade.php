<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api-token" content="{{ $user->api_token }}">
        <meta name="user_id" content="{{ $user->id }}">
        
        <title>@yield('title')</title>

        <!-- Scripts -->
        
        <script src="{{ secure_asset('js/feed.js') }}" defer></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/base.css') }}" rel="stylesheet">
        <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
        <link href="{{ asset('css/feed.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div id="app">
            @yield('content_news')
            
            <footer class="py-4" style="background-color:#888;clear:both;">
                @yield('footer')
            </footer>
        </div>
    </body>
</html>