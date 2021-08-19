<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky">
    <div class="container">
            <a class="navbar-brand logo" href="{{ url('/') }}">
                <img src="/img/F.png">USZERKA<img src="/img/pil.png">
                <!--img src="/img/logo.png"-->
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
          
            <div id="navbarColor01">
              <ul class="navbar-nav mr-auto toggle-on-right">
                <li class="nav-item">
                  <a class="nav-link" href="/">Strona główna</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/fuszerki">Top fuszerki</a>
                </li>
                {{--<li class="nav-item">
                    <a class="nav-link" href="/profeski">Max profeski</a>
                </li>--}}

                <li class="nav-item">
                    <a class="nav-link" href="/home">ZGŁOŚ FUSZERKĘ</a>
                </li>

                @auth

                  @if(Auth::user()->name == 'Administrator')
                    <li class="nav-item">
                        <a class="nav-link" href="/queue">Queue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rejected">Rejected</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/traffic">Traffic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>
                  @endif

                @endauth

              </ul>
            </div>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto toggle-on-right">
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

                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                @endguest
            </ul>
        </div>
    </div>
</nav>