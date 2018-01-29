<h2 class="blog-post-title">

  <a href="/posts/{{ $post->id }}" >

    {{ $post->title }}
    
  </a>

</h2>

<p class="blog-post-meta"><a href="#">{{ $post->user->name }}</a> {{ $post->created_at->toDateTimeString() }}</p>

{{ $post->body }}