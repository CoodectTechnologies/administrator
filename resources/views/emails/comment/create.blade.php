@component('mail::message')

<img loading="lazy" src="{{ $model->imagePreview() }}" class="img-fluid" alt="{{ $model->name }}">

@component('mail::panel')
{{ $title }}
@endcomponent

<p>Nombre: {{ $comment->name }}</p>
<p>Correo: {{ $comment->email }}</p>
<p>Mensaje: {{ $comment->body }}</p>

@component('mail::button', ['url' => $url])
Ver comentario
@endcomponent

{{ config('app.name') }}
@endcomponent

