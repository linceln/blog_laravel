<h5>
	<a href="/posts/{{ $post->id }}" >
		{{ $post->title }}
	</a>
</h5>

<p class="blog-post-meta">
	<a href="#">{{ $post->user->name }}</a> 
	{{ $post->created_at->toDateTimeString() }}
	@foreach ($post->tags as $tag)
	<span class="badge badge-pill badge-success">{{ $tag->name }}</span>
	@endforeach
</p>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
{{ $post->body }}