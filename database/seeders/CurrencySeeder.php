<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Peso méxicano',
                'code' => 'MXN',
            ],
            [
                'name' => 'Dólar estadounidense',
                'code' => 'USD',
            ],
        ];
        Currency::insert($currencies);
        Cache::forget('currency');
        $currencies = Currency::orderBy('name')->get();
        Cache::put('currency', $currencies);
    }
}
