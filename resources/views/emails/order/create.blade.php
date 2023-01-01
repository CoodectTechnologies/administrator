@component('mail::message')

@component('mail::panel')
Nueva orden #{{ $order->number }}
@endcomponent

@component('mail::table')
| Producto | Cantidad | Precio |
| -------- |:--------:| ------:|
@foreach ($order->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} | ${{ number_format($product->pivot->price, 2) }} |
@endforeach
@endcomponent

<p>#Envio: {{ $order->shippingPriceToString() }}</p>
<p>#Subtotal: {{ $order->subtotalToString() }}</p>
<p>#Total: {{ $order->totalToString() }}</p>

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp').'?text=Hola que tal! tengo un pedido '.$order->number])
Contáctanos en WhatsApp
@endcomponent

{{ config('app.name') }}
@endcomponent
