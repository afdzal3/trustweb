<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="d-flex flex-wrap">
      @foreach($qdata as $adata)
      <div class="visible-print border text-center">
        <p>Scan to check in</p>
        {!! QrCode::size(250)->generate($adata['qrcode']); !!}
        <p>{{ $adata['label'] }}</p>
        <p>Visit <a href="https://trust.tm.com.my/info">https://trust.tm.com.my/info</a> for more info</p>
      </div>
      @endforeach
    </div>
  </div>
</body>
</html>
