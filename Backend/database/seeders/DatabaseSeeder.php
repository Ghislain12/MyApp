<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Customer;
use App\Models\Measure;
use App\Models\ModelImage;
use App\Models\Orders;
use Illuminate\Database\Seeder;
use Database\Factories\CustomerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        Customer::factory()->count(100)->create();
        ModelImage::factory()->count(100)->create();
        Orders::factory()->count(200)->create();
        Measure::factory()->count(100)->create();
    }
}
