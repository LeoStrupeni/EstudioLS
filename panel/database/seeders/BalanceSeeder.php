<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Balance::create([
            'type' => 'client',
            'type_money' => 'dolar',
            'price' => 0,
            'last_detail' => 'Initial balance'
        ]);

        Balance::create([
            'type' => 'client',
            'type_money' => 'peso',
            'price' => 0,
            'last_detail' => 'Initial balance'
        ]);
        Balance::create([
            'type' => 'caja',
            'type_money' => 'dolar',
            'price' => 0,
            'last_detail' => 'Initial balance'
        ]);
        Balance::create([
            'type' => 'caja',
            'type_money' => 'peso',
            'price' => 0,
            'last_detail' => 'Initial balance'
        ]);
    }
}
