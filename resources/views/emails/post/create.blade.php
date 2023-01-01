@component('mail::message')

<img loading="lazy" src="{{ $blogPost->imagePreview() }}" class="img-fluid" alt="{{ $blogPost->name }}">

@component('mail::panel')
{{$blogPost->fragment}}
@endcomponent

Te invitamos a ver nuestro nuevo post :D
@component('mail::button', ['url' => route('web.blog.show', $blogPost)])
Ver blog
@endcomponent

{{ config('app.name') }}
@endcomponent

