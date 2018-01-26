@extends('layouts.master')


@section('content')
<div class="col-sm-8 blog-main">

  <div class="blog-post">

    @foreach($posts as $post)

    <h2 class="blog-post-title">

      <a href="/post/{{ $post->id }}" >

        {{ $post->title }}
        
      </a>

    </h2>

    <p class="blog-post-meta">{{ $post->created_at->toDateTimeString() }} by <a href="#">Mark(Hardcoded)</a></p>

    {{ $post->body }}

    <hr>

    @endforeach

  </div>

  <nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
  </nav>

</div>
@endsection