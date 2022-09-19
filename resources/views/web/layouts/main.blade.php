<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta Tags --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta http-equiv="Content-Language" content="es" />
    <meta name="author" content="{{ config('app.name') }}" />
    <meta name="resource-type" content="document" />
    <meta name="Revisit" content="2 days" />
    <meta name="robots" content="all"/>    
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ asset('assets/admin/media/logo/favicons/android-icon-192x192.png') }}" />
    <meta property="og:site_name" content="" />
    <meta name="twitter:card" content="summary" />

    {{-- Favicons --}}
    @include('admin.components.favicons')

    {{-- Noscript --}}
    <noscript>Your browser does not support JavaScript!</noscript>

    {{-- Css --}}

    {{-- Livewire --}}
    @livewireStyles

    {{-- Production --}}
    @production
    @endproduction

    {{-- Custom --}}
    @yield('head')
    @stack('head')
</head>

<body>
    {{-- Page --}}
    @include('web.layouts.header')
    @yield('content')
    @include('web.layouts.footer')
    
    {{-- Scripts --}}
    @livewireScripts
    @yield('footer')
	@stack('footer')
</body>
</html>