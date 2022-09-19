@component('mail::message')

<img loading="lazy" src="{{ $blogPost->imagePreview() }}" class="img-fluid" alt="{{ $blogPost->name }}">

@component('mail::panel')
Tienes un nuevo comentario
@endcomponent

<p>Nombre: {{ $comment->name }}</p>
<p>Correo: {{ $comment->email }}</p>
<p>Mensaje: {{ $comment->body }}</p>

@component('mail::button', ['url' => route('admin.blog.post.show', $blogPost)])
Ver comentario
@endcomponent

{{ config('app.name') }}
@endcomponent

