<?php

namespace Database\Seeders;

use App\Models\Keeper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class KeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keeper::create([
            'name' => 'Mohammad Saour',
            'email' => 'amaleabannour026@gmail.com',
            'phone_number'=>'0953582062',
            'password' => Crypt::encrypt('87654321'),
            'warehouse_id' => 1,
        ]);
        Keeper::create([
            'name' => 'Ahmad Naser',
            'email' => 'rmooshebannour@gmail.com',
            'phone_number'=>'0934890163',
            'password' => Crypt::encrypt('12345678'),
            'warehouse_id' => 2,
        ]);

        Keeper::create([
            'name' => 'Fares Jalal',
            'email' => 'helezta19@gmail.com',
            'phone_number'=>'0996488901',
            'password' => Crypt::encrypt('1234567890'),
            'warehouse_id' => 3,
        ]);
    }
}
