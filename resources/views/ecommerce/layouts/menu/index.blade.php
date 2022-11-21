<nav class="main-nav">
    <ul class="menu">
        <li class="active">
            <a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a>
        </li>
        <li class="{{ route('ecommerce.product.index') }}">
            <a href="{{ route('ecommerce.home.index') }}">{{ __('Products') }}</a>
        </li>
        <li class="">
            <a href="{{ route('ecommerce.home.index') }}">{{ __('About') }}</a>
        </li>
        <li class="">
            <a href="{{ route('ecommerce.home.index') }}">{{ __('Contact') }}</a>
        </li>
    </ul>
</nav>
