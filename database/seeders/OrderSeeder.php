<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = [[
            'user_id' => 1,
            'shipping_address_id' => 1,
            'number' => '00000001-2022',
            'subtotal' => 95,
            'total' => 100,
            'shipping_price' => 5,
            'payment_method' => 'PayPal',
            'status' => 'Procesando'
        ]];
        Order::insert($order);        
    }
}
