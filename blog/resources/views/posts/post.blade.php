<h5>
	<a href="/posts/{{ $post->id }}" >
		{{ $post->title }}
	</a>
</h5>

<p class="blog-post-meta">
	<a href="#">{{ $post->user->name }}</a> 
	{{ $post->created_at->toDateString() }}
	@foreach ($post->tags as $tag)
	<span class="badge badge-pill badge-success">{{ $tag->name }}</span>
	@endforeach
</p>
{{ $post->body }}