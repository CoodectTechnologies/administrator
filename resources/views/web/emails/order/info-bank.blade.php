@component('mail::message')

@component('mail::panel')
Información de transferencia o deposito: orden #{{ $order->number }}
@endcomponent

<p class="lead">Deberás de mandar el comprobante de pago y número de pedido {{ $order->number }} al número de WhatsApp o por correo electronico. </p>
<h4>Datos bancarios</h4>
Cuenta bancaria: {{ config('payment.account_bank') }} <br>
Tarjeta: {{ config('payment.target') }} <br>
Banco: {{ config('payment.bank') }} <br>
A nombre de: {{ config('payment.name') }} <br>

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp')])
Enviar comprobante por WhatsApp
@endcomponent

@component('mail::button', ['url' => 'mailto:'.config('contact.email')])
Enviar comprobante por correo
@endcomponent

{{ config('app.name') }}
@endcomponent
