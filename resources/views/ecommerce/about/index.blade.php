
@extends('ecommerce.layouts.main')

@section('head')
    <title>Nosotros - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Nosotros" />
    <meta name="description" content="{{ config('app.name') }} - Nosotros" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Nosotros" />
    <meta property="og:title" content="{{ config('app.name') }} - Nosotros" />
    <meta property="og:description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="keywords" content="{{ config('app.name') }}, Nosotros" />
    <meta property="og:url" content="{{ route('ecommerce.about.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Nosotros" />
@endsection

@section('content')

@endsection
