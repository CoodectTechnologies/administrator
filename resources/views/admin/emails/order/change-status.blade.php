@component('mail::message')
# Status: {{ $order->status }}

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp')])
Contáctanos en WhatsApp
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
