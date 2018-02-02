@extends('layouts.master')

@section('content')
<div class="col-sm-8 blog-main">
  <div class="blog-post">

    @foreach($posts as $post)
    @include('posts.post')
    <hr>
    @endforeach
  </div>

  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">

        <a class="page-link" aria-label="Previous" href="{{ $posts->previousPageUrl() }}">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>

      @for ($i = 0; $i < $posts->lastPage(); $i++)
      <li class="page-item"><a class="page-link" href="/?page={{ $i + 1 }}{{ $param }}">{{ $i + 1  }}</a></li>
      @endfor

      <li class="page-item">
        <a class="page-link" aria-label="Next" href="{{ $posts->nextPageUrl() }}">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>

    </ul>
  </nav>

</div>
@endsection