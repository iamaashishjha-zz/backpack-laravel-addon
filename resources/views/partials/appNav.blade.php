<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <form action="{{url('/locale')}}" method="post">
                    @csrf
                    <select class="form-select" name="locale" onchange="this.form.submit()">
                        <option value="en" {{ (App::currentLocale() == 'en') ? 'selected' : '' }}>English</option>
                        <option value="np" {{ (App::currentLocale() == 'np') ? 'selected' : '' }}>नेपाली</option>
                    </select>
                </form>
            </ul>
            {{-- <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        @foreach (\App\Models\MenuItem::getTree(); as $item)
                        <li class="nav-item active">
                            <a class="nav-link" href="{{$item->url()}}">
            {{ $item->name }}
            </a>
            </li>
            @endforeach
            </ul> --}}

            @php
            // $$item->children = \App\Models\MenuItem::Where('parent_id', !=, 0)

            @endphp

            {{-- @if(count($menus)) --}}
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                @foreach(\App\Models\MenuItem::getTree(); as $menu)
                <li class=" {{count($menu->children)?'dropdown':''}}">
                    <a href="{{ (count($menu->children)) ? '#' : url($menu->link) }} " data-toggle="dropdown">
                        {{$menu->name}}
                        <span class="caret"></span>
                    </a>
                    @if(count($menu->children))
                    <ul class="dropdown-menu">
                        @foreach ($menu->children as $child)
                        <li class="pl-4 px-0"> <a href="{{url($child->link)}}">{{$child->name}}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach

            </ul>




            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
