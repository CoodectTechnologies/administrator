<nav class="main-nav">
    <ul class="menu">
        <li class="{{ active('ecommerce.home.index') }}">
            <a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a>
        </li>
        <li class="{{ active('ecommerce.product.index') }}">
            <a href="{{ route('ecommerce.product.index') }}">{{ __('Products') }}</a>
        </li>
        <li class="{{ active('ecommerce.about.index') }}">
            <a href="{{ route('ecommerce.about.index') }}">{{ __('About') }}</a>
        </li>
        <li class="{{ active('ecommerce.contact.index') }}">
            <a href="{{ route('ecommerce.contact.index') }}">{{ __('Contact') }}</a>
        </li>
    </ul>
</nav>
