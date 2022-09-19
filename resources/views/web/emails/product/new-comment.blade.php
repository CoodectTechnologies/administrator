@component('mail::message')

<img loading="lazy" src="{{ $product->imagePreview() }}" class="img-fluid" alt="{{ $product->name }}">

@component('mail::panel')
Tienes un nuevo comentario
@endcomponent

<p>Nombre: {{ $comment->name }}</p>
<p>Correo: {{ $comment->email }}</p>
<p>Mensaje: {{ $comment->body }}</p>

@component('mail::button', ['url' => route('admin.catalog.product.edit', ['product' =>  $product, 'submodule' => 'comments'])])
Ver comentario
@endcomponent

{{ config('app.name') }}
@endcomponent

