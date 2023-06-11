<style>
  body {
  background-color: #e74c3c;
  animation: bg-color 10s infinite;
}
@keyframes bg-color {
  0% { background-color: #e74c3c; }
  20% { background-color: #f1c40f; }
  40% { background-color: #1abc9c; }
  60% { background-color: #3498db; }
  80% { background-color: #9b59b6; }
  100% { background-color: #e74c3c; }
}
/* ローディング画面 */
#loading {
  width: 100vw;
  height: 100vh;
  transition: all 1s;
  background-color: #0bd;
 
/* 以下のコードを追加 */
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
}
.loaded {
  opacity: 0;
  visibility: hidden;
}
.spinner {
  width: 100px;
  height: 100px;
  margin: 200px auto;
  background-color: #fff;
  border-radius: 100%;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}
/* ローディングアニメーション */
@keyframes sk-scaleout {
  0% {
    transform: scale(0);
  } 100% {
    transform: scale(1.0);
    opacity: 0;
  }
}
 
/* コンテンツ部分の装飾 */
.gallery {
  display: grid;
  gap: .5rem;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}
.loader {
  color: #ffffff;
  font-size: 20px;
  margin: 200px auto;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  position: relative;
  text-indent: -9999em;
  -webkit-animation: load4 1.3s infinite linear;
  animation: load4 1.3s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
@-webkit-keyframes load4 {
  0%,
  100% {
    box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
  }
  12.5% {
    box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  25% {
    box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  37.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  50% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  62.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
  }
  75% {
    box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
  }
  87.5% {
    box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
  }
}
@keyframes load4 {
  0%,
  100% {
    box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
  }
  12.5% {
    box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  25% {
    box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  37.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  50% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  62.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
  }
  75% {
    box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
  }
  87.5% {
    box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
  }
}

  img {
    width: 100% !important;
    height: auto !important;
  }
</style>
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    window.onload = function() {
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
}
</script>
<div id="loading">
  
  <div class="loader"></div>
  <div style="text-align: center;color:#fff;margin-top:-100px;font-size:2em;">Loading...</div>
</div>

<!-- <div id="app">
  <spinner></spinner>
</div> -->
<div class="container-lg" style="width:900px;overflow:hidden;margin:0 auto;display:flex;flex-wrap:wrap;">
@foreach($rss_content as $value)
  <div style="width:45%;margin:2%">
    <h2 style="font-size:1em;height:2em">{{ $value['title'] }}</h2>
    <div style="width:45%;float:left;padding:2%;">
      <img src="{{ $value['img_path'] }}">
    </div>
    <div style="width:50%;float:right;">
      <p style="font-size:0.9em;">{{ $value['description'] }}&hellip;</p>
      <p style="font-size:0.9em;">{{ $value['team'] }}</p>
      <p style="font-size:0.8em;">{{ $value['date'] }}</p>
      {{ $value['news_id'] }}
    </div>
  <br><br><br>
  </div>
  
@endforeach
{{ $rss_content->links() }}
</div>


