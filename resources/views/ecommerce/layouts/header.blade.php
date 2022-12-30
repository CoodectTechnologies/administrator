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
                    <div class="dropdown-box">
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
                @endauth
                @guest
                    <a href="#" class="d-lg-show login sign-in">
                        <i class="w-icon-account"></i>{{ __('Sign in') }}
                    </a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="#" class="ml-0 d-lg-show login register">{{ __('Register') }}</a>
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
                <a class="wishlist label-down link d-xs-show" href="#">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">{{ __('Wishlist') }}</span>
                </a>
                <a class="compare label-down link d-xs-show" href="#">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">{{ __('Compare') }}</span>
                </a>
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="{{ route('ecommerce.cart.index') }}" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">{{ Cart::count() }}</span>
                        </i>
                        <span class="cart-label">{{ __('Cart') }}</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="products">
                            @foreach (Cart::content() as $item)
                                <div class="product product-cart">
                                    <div class="product-detail">
                                        <a href="{{ route('ecommerce.product.show', $item->model) }}" class="product-name">
                                            {{ $item->name }}
                                        </a>
                                        <div class="price-box">
                                            <span class="product-quantity">{{ $item->qty }}</span>
                                            <span class="product-price">{{ $item->subtotal() }}</span>
                                        </div>
                                    </div>
                                    <figure class="product-media">
                                        <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                            <img src="{{ $item->model->imageProduct() }}" alt="{{ $item->name }}" height="84" width="94" />
                                        </a>
                                    </figure>
                                    <button class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Blue utility
                                        pina<br>fore
                                        denim dress</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$32.99</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="https://portotheme.com/html/wolmart/assets/images/cart/product-2.jpg" alt="product" width="84"
                                            height="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">{{ Cart::subtotal() }}</span>
                        </div>
                        <div class="cart-action">
                            <a href="{{ route('ecommerce.cart.index') }}" class="btn btn-dark btn-outline btn-rounded">Ver carrito</a>
                            <a href="{{ route('ecommerce.checkout.index') }}" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div>
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
