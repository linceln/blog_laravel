@extends('layouts.master')


@section('content')
<div class="col-sm-8 blog-main">

  <div class="blog-post">

    <strong>{{ $visits }}</strong>

    @foreach($posts as $post)

      @include('posts.post')

      <hr>

    @endforeach

  </div>

  <nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
  </nav>

</div>
@endsection