<nav class="navbar navbar-expand-sm navbar-light bg-info text-light" style=" background-color: #e3f2fd!important;">

    <div class="container-fluid">
        <a href="#" class="navbar-brand">Brand</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @foreach(\App\Models\MenuItem::getTree(); as $menu)
                @if (count($menu->children))
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $menu->name }}</a>
                    <div class="dropdown-menu">
                        @foreach ($menu->children as $child)
                        <a href="{{ url($child->link) }}" class="dropdown-item">{{$child->name}}</a>
                        @endforeach
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ url($menu->link) }}" class="nav-link">{{ $menu->name }}</a>
                </li>
                @endif
                @endforeach
            </ul>


            <ul class="navbar-nav me-auto">
                <form action="{{url('/locale')}}" method="post">
                    @csrf
                    <select class="form-select" name="locale" onchange="this.form.submit()">
                        <option value="en" {{ (App::currentLocale() == 'en') ? 'selected' : '' }}>English</option>
                        <option value="np" {{ (App::currentLocale() == 'np') ? 'selected' : '' }}>नेपाली</option>
                    </select>
                </form>
            </ul>


            @if (Auth::user())
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="/home" class="dropdown-item">Home</a>
                        <div class="dropdown-divider"></div>
                        <a href="/admin" class="dropdown-item">Admin Panel</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </li>
            </ul>
            @endif
        </div>
    </div>
</nav>
