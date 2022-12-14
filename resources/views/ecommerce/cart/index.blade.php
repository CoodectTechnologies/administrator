
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Carrito') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Carrito" />
    <meta name="description" content="{{ config('app.name') }} - Carrito" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Carrito" />
    <meta property="og:title" content="{{ config('app.name') }} - Carrito" />
    <meta property="og:description" content="{{ config('app.name') }} - Carrito" />
    <meta name="description" content="{{ config('app.name') }} - Carrito" />
    <meta name="keywords" content="{{ config('app.name') }}, Carrito" />
    <meta property="og:url" content="{{ route('ecommerce.cart.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Carrito" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Carrito" />
@endsection

@section('content')
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="active"><a href="#">{{ __('Cart') }}</a></li>
                <li><a href="{{ route('ecommerce.checkout.index') }}">{{ __('Checkout') }}</a></li>
                <li><a href="{{ route('ecommerce.checkout.index') }}">{{ __('Payment') }}</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.cart.index')
@endsection
