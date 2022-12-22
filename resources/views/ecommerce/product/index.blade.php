
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ config('app.name') }} - Productos</title>
    <meta name="title" content="{{ config('app.name') }} - Productos" />
    <meta name="description" content="{{ config('app.name') }} - Productos" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Productos" />
    <meta property="og:title" content="{{ config('app.name') }} - Productos" />
    <meta property="og:description" content="{{ config('app.name') }} - Productos" />
    <meta name="description" content="{{ config('app.name') }} - Productos" />
    <meta name="keywords" content="{{ config('app.name') }}, Productos" />
    <meta property="og:url" content="{{ route('ecommerce.product.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Productos" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Productos" />
@endsection

@section('content')
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Products') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.product.index')
@endsection
