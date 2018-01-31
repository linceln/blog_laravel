<div class="col-sm-3 offset-sm-1 blog-sidebar">

  <div class="sidebar-module">
    <h4>Tags</h4>
    <ol class="list-unstyled">
      @foreach ($tags as $tag)
      <li><a href="/posts?tag={{ $tag }}">{{ $tag }}</a></li>
      @endforeach
    </ol>
  </div>

  <div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">
      @foreach ($archives as $archive)
      <li><a href="/posts?month={{ $archive->month }}&year={{ $archive->year }}">{{ $archive->month }}  {{ $archive->year }}</a></li>
      @endforeach
    </ol>

  </div>

</div>
