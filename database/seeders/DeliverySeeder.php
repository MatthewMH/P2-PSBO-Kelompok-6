<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::truncate();        
        Delivery::create([
           'delivery_name' => 'JNE',
           'delivery_price' => 8000,
        ]);
        Delivery::create([
            'delivery_name' => 'SiCepat',
            'delivery_price' => 5000,
        ]);
        Delivery::create([
            'delivery_name' => 'Wahana',
            'delivery_price' => 7000,
        ]);        
    }
}
