@component('mail::message')
# Pago: {{ $order->payment_status }}

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp').'?text=Hola que tal! ¿Cómo va mi pedido? '.$order->number])
Contáctanos en WhatsApp
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
