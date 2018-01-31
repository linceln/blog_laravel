@extends('layouts.master')

@section('content')

<div class="col-sm-8 blog-main">

	<h2 class="blog-post-title">{{ $post->title }}</h2>
	<p class="blog-post-meta"><a href="#">{{ $post->user->name }}</a> {{ $post->created_at->toDateTimeString() }}</p>
	{{ $post->body }}
	<hr>

	<div class="comments">
		<ul class="list-group">
			@foreach($post->comments()->latest()->get() as $comment)
			<li class="list-group-item">
				<p>
					<a href="#">{{ $comment->user->name }}</a>：{{ $comment->content }}
				</p>
				<hr>
				<strong>
					{{ $comment->created_at->diffForHumans() }}
				</strong>
			</li>
			@endforeach
		</ul>
	</div>

	<hr>

	<form method="POST" action="/posts/{{ $post->id }}/comments">

		{{ csrf_field() }}

		<div class="form-group">
			<textarea type="text" class="form-control form-control-lg" name="comment" required></textarea>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Comment</button>
		</div>

		@include('layouts.error')
		
	</form>
</div>

@endsection