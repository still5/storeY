<!-- HEADER -->
<header class="header-item flex-row" >
    <div class="navigation flex-row">
        @auth
        <nav role="navigation">
            <div class="hamburger-menu">
                <input id="menu__toggle" type="checkbox" />
                <label class="menu__btn" for="menu__toggle">
                    <span></span>
                </label>

                <ul class="menu__box">
                    <li><a class="menu__item" href="/">Catalog</a></li>
                    @if(Auth::user()->is_admin)
                        <li><a class="menu__item" href="/orders">Orders</a></li>
                        <li><a class="menu__item" href="/product">Create product</a></li>
                    @endif
                    <li><a class="menu__item" href="/dashboard">Dashboard</a></li>
                </ul>
            </div>
        </nav>
        @endauth
    </div>
    <div class="header-logo flex-row">
        <a href="{{ route('home') }}" class="logo block">
            <img src="{{ asset('/img/ConEl-Catalogue-sample.jpg') }}" alt="storey-logo" width="220px" height="60px"
                 class="logo__img logo__img_desktop">
        </a>
    </div>
    <div class="user-icon flex-row">
        @if(Route::current()->getName() != 'login')
            @guest
                <div class="auth-user-icon" tabindex="0">
                    <a href="{{ route('login') }}">{{ __('Log in') }}</a>
                </div>
            @endguest
            @auth
                <div class="dropdown" tabindex="0">
                    <button class="dropdown-btn" aria-haspopup="menu">
                        <span>{{ Auth::user()->name }}</span>
                        <span class="arrow"></span>
                    </button>
                    <ul class="dropdown-content" role="menu">
                        <li><a href="{{route('profile.edit')}}">{{ __('Profile') }}</a></li>
                        <li><form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{route('logout')}}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        @endif
    </div>
</header>
