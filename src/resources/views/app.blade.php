<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta property="og:url" content="{{ url()->full() }}">
  <meta property="og:title" content="ARCase">
  <meta property="og:description" content="AR,VRの作品多数! 新しい発見がここにある!">
  <meta property="og:site_name" content="ARCAse">
  <meta property="og:image" content="{{ asset('img/ARCase.png') }}">
  <meta name="twitter:card" content="summary" />
  <title>
    @yield('title')
  </title>
  {{-- Faviconの設定 --}}
  <link rel="icon" href="{{ asset('img/favicon.ico') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
  <div id="app">
    @yield('content')
  </div>

  <script src="{{ mix('js/app.js') }}"></script>

  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
  </script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
</body>

</html>