<div class="blog-masthead">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 blog-main">
        <nav class="nav blog-nav">
          <a class="nav-link active" href="/">Home</a>
          <a class="nav-link" href="#">New features</a>
          <a class="nav-link" href="#">Press</a>
          <a class="nav-link" href="#"><span class="badge badge-pill badge-warning">{{ $visits }}</span></a>
        </nav>
      </div>

      <div class="col-sm-4 blog-main">
        <nav class="nav blog-nav justify-content-end">
          @if(auth()->check())
          <a class="nav-link" href="/logout">{{ auth()->user()->name }}</a>
          @else
          <a class="nav-link" href="/login">SIGN IN</a>
          <a class="nav-link" href="/register">SIGN UP</a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>