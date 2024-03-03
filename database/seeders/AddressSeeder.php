<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //UserAddress::factory(30000)->create();
        $i = 0;
        while($i <= 30000){
            UserAddress::create([
                'user_id' => User::all()->random()->id,
                'address' => 'Rajkot, Gujarat, India',
            ]);
        }
    }
}
