<h2 class="blog-post-title">

  <a href="/posts/{{ $post->id }}" >

    {{ $post->title }}
    
  </a>

</h2>

<p class="blog-post-meta">{{ $post->created_at->toDateTimeString() }} by <a href="#">Mark(Hardcoded)</a></p>

{{ $post->body }}