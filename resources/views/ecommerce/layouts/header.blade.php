<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">¡{{ __('Welcome to') }} {{ config('app.name') }}!</p>
            </div>
            <div class="header-right pr-0">
                <div class="dropdown">
                    <a href="#currency"><span class="text-uppercase">{{ Session::get('currency') }}</span></a>
                    <div wire:ignore.self class="dropdown-box">
                        @foreach (Cache::get('currencies') ?? [] as $currency)
                            <a href="{{ route('ecommerce.currency', $currency->code) }}">{{ $currency->code }}</a>
                        @endforeach
                    </div>
                </div>
                <!-- End of DropDown Menu -->
                <div class="dropdown">
                    <a href="#language">
                        <img src="{{ asset('assets/ecommerce') }}/images/flags/{{ Session::get('language') }}.png" alt="{{ Session::get('language') }} {{ config('app.name') }}" width="14" height="8" class="dropdown-image" /> <span class="text-uppercase">{{ Session::get('language') }}</span>
                    </a>
                    <div class="dropdown-box">
                        <a href="{{ route('ecommerce.language', 'es') }}">
                            <img src="{{ asset('assets/ecommerce') }}/images/flags/es.png" alt="MX {{ Session::get('language') }}" width="14" height="8" class="dropdown-image" />
                            ES
                        </a>
                        <a href="{{ route('ecommerce.language', 'en') }}">
                            <img src="{{ asset('assets/ecommerce') }}/images/flags/en.png" alt="USA {{ config('app.name') }}" width="14" height="8" class="dropdown-image" />
                            EN
                        </a>
                    </div>
                </div>
                <!-- End of Dropdown Menu -->
                <span class="divider d-lg-show"></span>
                {{-- <a href="blog.html" class="d-lg-show">Blog</a> --}}
                <a href="#" class="d-lg-show">{{ __('Contact us') }}</a>
                @auth
                    <a href="#" class="d-lg-show">{{ __('My account') }}</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="ml-0 d-lg-show login">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="d-lg-show login sign-in">
                        <i class="w-icon-account"></i>{{ __('Sign in') }}
                    </a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="{{ route('register') }}" class="ml-0 d-lg-show login register">{{ __('Register') }}</a>
                @endguest
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                </a>
                <a href="{{ route('ecommerce.home.index') }}" class="logo ml-lg-0">
                    <img src="{{ config('app.logo') }}" alt="logo" width="200" />
                </a>
                @include('ecommerce.layouts.menu.index')
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:{{ config('contact.phone') }}" class="w-icon-call"></a>
                    <div class="call-info d-xl-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="mailto:{{ config('contact.email') }}" class="text-capitalize">{{ __('Email') }} </a> o:</h4>
                        <a href="tel:{{ config('contact.phone') }}" class="phone-number font-weight-bolder ls-50">{{ config('contact.phone') }}</a>
                    </div>
                </div>
                @livewire('ecommerce.layouts.wishlist')
                <a class="compare label-down link d-xs-show" href="#">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">{{ __('Compare') }}</span>
                </a>
                @livewire('ecommerce.layouts.cart')
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->
    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left flex-1">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>{{ __('Search category') }}</span>
                        </a>
                        @include('ecommerce.layouts.menu.category')
                    </div>
                    <form method="get" action="#" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                        <input type="text" class="form-control" name="search" id="search"
                            placeholder="{{ __('Search') }} ..." required />
                        <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                        </button>
                    </form>
                </div>
                <div class="header-right pr-0 ml-4">
                    @if (config('contact.facebook'))
                        <a href="{{ config('contact.facebook') }}" class="d-xl-show mr-6"><i class="fab fa-facebook fa-2x mr-1"></i> Facebook</a>
                    @endif
                    @if (config('contact.instagram'))
                        <a href="{{ config('contact.instagram') }}" class="d-xl-show mr-6"><i class="fab fa-instagram fa-2x mr-1"></i> Instagram</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
