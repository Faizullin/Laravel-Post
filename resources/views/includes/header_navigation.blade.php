<ul class="navbar-nav me-auto">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('home')}}">Main</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('about')}}">About us</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('post.index')}}">Posts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('post.create')}}">Create Post</a>
  </li>
  @can('view',auth()->user())
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.main.index')}}">Admin</a>
    </li>
  @endcan
</ul>