<meta charset="utf-8">
<meta name="description" content="">
<meta name="Saquib" content="Blade">
<title>Checkout our layout</title>
<!-- load bootstrap from a cdn -->

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
  
      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="stylesheet" href="{{('/css/app.css')}}">
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  
      <!-- Scripts -->
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>