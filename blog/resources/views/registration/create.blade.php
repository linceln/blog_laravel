@extends('layouts.master')


@section('content')

<div class="col-sm-8 blog-main">



	<form method="POST" action="/register">


		{{ csrf_field() }}


		<div class="form-group">

			<label for="name">Name</label>

			<input type="text" class="form-control form-control-lg" id="name" name="name" required>

		</div>


		<div class="form-group">

			<label for="email">Email</label>

			<input type="email" class="form-control form-control-lg" id="email" name="email" required>

		</div>


		<div class="form-group">

			<label for="password">Password</label>

			<input type="password" class="form-control form-control-lg" id="password" name="password" required>

		</div>


		<div class="form-group">

			<label for="password_confirmation">Password Confirmation</label>

			<input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" required>


		</div>


		<div class="form-group">

			<button type="submit" class="btn btn-primary">Sign Up</button>

		</div>


		@include('layouts.error')


	</form>


</div>

@endsection