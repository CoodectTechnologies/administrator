
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ config('app.name') }} - {{ $product->name }}</title>
    <meta name="title" content="{{ config('app.name') }} - {{ $product->meta_title }}" />
    <meta name="description" content="{{ $product->meta_description }}" />
    <meta http-equiv="title" content="{{ $product->meta_title }}" />
    <meta property="og:title" content="{{ $product->meta_title }}" />
    <meta property="og:description" content="{{ $product->meta_description }}" />
    <meta name="description" content="{{ $product->meta_description }}" />
    <meta name="keywords" content="{{ config('app.name') }}, {{ $product->meta_keywords }}" />
    <meta property="og:url" content="{{ route('ecommerce.product.index') }}" />
    <meta name="twitter:description" content="{{ $product->meta_description }}" />
    <meta name="twitter:title" content="{{ $product->meta_title }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/photoswipe/default-skin/default-skin.min.css">
@endsection

@section('content')
   <!-- Start of Breadcrumb -->
   <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('ecommerce.product.index') }}">{{ __('Products') }}</a></li>
            <li class="active">{{ $product->name }}</li>
        </ul>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.product.show', ['product' => $product])
@endsection

@section('footer')
    <!-- Plugin JS File -->
    <script src="{{ asset('assets/ecommerce') }}/vendor/sticky/sticky.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/zoom/jquery.zoom.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe-ui-default.js"></script>
@endsection
