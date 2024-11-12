<?php

namespace Database\Seeders;

use App\Models\Manager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::create([
            'name' => 'Ramez Bekri',
            'email' => 'lahiba70@gmail.com',
            'password' => bcrypt('0987654321'),
            'is_activated'=>true,
            'email_verified_at'=>Carbon::now()
        ]);
    }
}
