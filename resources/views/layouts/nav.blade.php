<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="nav navbar-collapse" id="appp-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-link">
                    <li class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse</a>
                        <ul class="dropdown-menu">
                            <li><a href="/threads">All Threads</a></li>
                            @auth
                            <li><a href="/threads?by={{ auth()->user()->name }}">My Threads</a></li>
                            @endauth
                            <li><a href="/threads?popular=1">Popular Threads</a></li>
                        </ul>
                    </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/threads/create') }}">Add Thread</a>
                </li>
                <li class="nav-link">
                    <li class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Channels</a>
                        <ul class="dropdown-menu">
                            @foreach ($channels as $channel)
                            <li><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></li>
                            @endforeach
                          {{-- <li role="separator" class="divider"></li> --}}
                        </ul>
                    </li>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', auth()->user()) }}">
                                Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>