<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/favicon.ico">
  <title>Blog</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/blog.css" rel="stylesheet">
</head>
<body>
  @include('layouts.nav')
  <div class="blog-header">
    <div class="container">
      @if ($flash = session('msg'))
      <div class="alert alert-success" id="flash-message" role="alert">{{ $flash }}</div>
      @endif
      <h1 class="blog-title">The Bootstrap Blog</h1>
      <p class="lead blog-description">An example blog template built with  Bootstrap.</p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      @yield('content')
      @include('layouts.sidebar')
    </div>
  </div>
  @include('layouts.footer')
</body>
</html>