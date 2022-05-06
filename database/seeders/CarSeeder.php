<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'name' => 'Mercedes Benz'
            ],
            [
                'name' => 'Lexus RX 350H'
            ],
            [
                'name' => 'Lada Priora'
            ]
        ];

        foreach($cars as $car) {
            Car::create([
                'name' => $car['name']
            ]);
        }
    }
}
