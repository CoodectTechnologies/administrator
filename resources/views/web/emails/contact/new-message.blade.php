@component('mail::message')

@component('mail::panel')
Tienes un nuevo mensaje por parte de la página web
@endcomponent

<p>Nombre: {{ $emailWeb->name }}</p>
<p>Teléfono: {{ $emailWeb->phone }}</p>
<p>Correo: {{ $emailWeb->email }}</p>
<p>Asunto: {{ $emailWeb->subject }}</p>
<p>Mensaje: {{ $emailWeb->body }}</p>

@component('mail::button', ['url' => 'mailto:'.$emailWeb->email])
Contestar correo
@endcomponent

@component('mail::button', ['url' => 'https://wa.me/+52'.$emailWeb->phone])
Contestar en WhatsApp
@endcomponent

{{ config('app.name') }}
@endcomponent

