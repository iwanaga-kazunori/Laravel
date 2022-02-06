<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/front.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="container center-block col-mid-10">
        <h2 class="mx-auto text-center">試合日程・結果</h2>
        <div id="app">
            <!--<matches-component></matches-component>-->
            <!--<example-component></example-component>-->
            <hooper-component></hooper-component>
        </div>
        
        
        
        
        <table class="col-mid-10 center-block mx-auto">
            <tr class="d-flex align-items-center">
                <td class="col text-center">ホーム</td>
                <td class="col text-center" colspan="3">スコア</td>
                <td class="col text-center">アウェイ</td>
            </tr>
            @foreach ($matches as $match)
                <!--<div>
                    id:{{ $match['id'] }}<br>
                    season:id:{{ $match['season']['id'] }}<br>
                    season:startDate:{{ $match['season']['startDate'] }}<br>
                    season:endDate:{{ $match['season']['endDate'] }}<br>
                    season:currentMatchday:{{ $match['season']['currentMatchday'] }}<br>
                    utcDate:{{ $match['utcDate'] }}<br>
                    status:{{ $match['status'] }}<br>
                    matchday:{{ $match['matchday'] }}<br>
                    stage:{{ $match['stage'] }}<br>
                    group:{{ $match['group'] }}<br>
                    lastUpdated:{{ $match['lastUpdated'] }}<br>
                    score:winner:{{ $match['score']['winner'] }}<br>
                    score:duration:{{ $match['score']['duration'] }}<br>
                    score:fullTime:homeTeam:{{ $match['score']['fullTime']['homeTeam'] }}<br>
                    score:fullTime:awayTeam:{{ $match['score']['fullTime']['awayTeam'] }}<br>
                    homeTeam:id:{{ $match['homeTeam']['id'] }}<br>
                    homeTeam:name:{{ $match['homeTeam']['name'] }}<br>
                    awayTeam:id:{{ $match['awayTeam']['id'] }}<br>
                    awayTeam:name:{{ $match['awayTeam']['name'] }}<br>
                    <img src="https://crests.football-data.org/{{ $match['homeTeam']['id'] }}.svg" height="30">
                </div>-->
                <tr class="d-flex align-items-center">
                    <td class="col p-3 text-center"><a href="{{ route('team.detail', ['id' => $match['homeTeam']['id'] ])}}"><img src="https://crests.football-data.org/{{ $match['homeTeam']['id'] }}.svg" width="70px"></a></td>
                    <td class="col p-3 text-center">{{ $match['score']['fullTime']['homeTeam'] }}</td>
                    <td class="col p-3 text-center">-</td>
                    <td class="col p-3 text-center">{{ $match['score']['fullTime']['awayTeam'] }}</td>
                    <td class="col p-3 text-center"><img src="https://crests.football-data.org/{{ $match['awayTeam']['id'] }}.svg" width="70px"></td>
                </tr>
                <tr class="d-flex align-items-center border-bottom">
                    <td class="col p-3 text-center">{{ $match['homeTeam']['name'] }}</td>
                    <td class="col p-3 text-center"></td>
                    <td class="col p-3 text-center">{{ $match['season']['startDate'] }}</td>
                    <td class="col p-3 text-center"></td>
                    <td class="col p-3 text-center">{{ $match['awayTeam']['name'] }}</td>
                </tr>
            
        
        @endforeach
        </table>
    </div>
</body>
</html>