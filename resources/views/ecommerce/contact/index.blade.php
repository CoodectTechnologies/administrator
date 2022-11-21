
@extends('ecommerce.layouts.main')

@section('head')
    <title>Contacto - {{ config('app.name') }} </title>
    <meta name="title" content="{{ config('app.name') }} - Contacto" />
    <meta name="description" content="{{ config('app.name') }} - Contacto" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Contacto" />
    <meta property="og:title" content="{{ config('app.name') }} - Contacto" />
    <meta property="og:description" content="{{ config('app.name') }} - Contacto" />
    <meta name="description" content="{{ config('app.name') }} - Contacto" />
    <meta name="keywords" content="{{ config('app.name') }}, Contacto" />
    <meta property="og:url" content="{{ route('ecommerce.contact.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Contacto" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Contacto" />
@endsection

@section('content')

@endsection
