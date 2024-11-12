<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //WAREHOUSE1
        // CLIENTS
        Client::create([
            'name' => 'Abdallah Darwesh',
            'phone_number' => '0930657981',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 37,
        ]);
        Client::create([
            'name' => 'Yasir Swedani',
            'phone_number' => '0957469233',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 40,
        ]);
        Client::create([
            'name' => 'Natheer Kanaan',
            'phone_number' => '0998811622',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 41,
        ]);
        Client::create([
            'name' => 'Mohammad Al Samman',
            'phone_number' => '0991959292',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 48,
        ]);
        Client::create([
            'name' => 'Bashir Al Shami',
            'phone_number' => '0968403455',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 63,
        ]);
        Client::create([
            'name' => 'Shadi Edris',
            'phone_number' => '0939116266',
            'is_company' => 0,
            'warehouse_id' => 1,
            'location_id' => 59,
        ]);
        //COMPANIES
        Client::create([
            'name' => 'Unifarma',
            'phone_number' => '0939116893',
            'is_company' => 1,
            'warehouse_id' => 1,
            'location_id' => 59,
        ]);

        // WAREHOUSE2
        // CLIENTS
        Client::create([
            'name' => 'Salim Nwelati',
            'phone_number' => '0955162403',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 5,
        ]);
        Client::create([
            'name' => 'Marwan Breniah',
            'phone_number' => '0997804931',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 2,
        ]);
        Client::create([
            'name' => 'Othman Hamdan',
            'phone_number' => '0954992654',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 6,
        ]);
        Client::create([
            'name' => 'Saeed Al Hamwi',
            'phone_number' => '0994868663',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 1,
        ]);
        Client::create([
            'name' => 'Abd Almalik Qalajo',
            'phone_number' => '0995165486',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 3,
        ]);
        Client::create([
            'name' => 'Abdallah Al Helwani',
            'phone_number' => '0968459756',
            'is_company' => 0,
            'warehouse_id' => 2,
            'location_id' => 4,
        ]);
        //COMPANIES
        Client::create([
            'name' => 'Salah Shamma',
            'phone_number' => '0939133266',
            'is_company' => 1,
            'warehouse_id' => 2,
            'location_id' => 3,
        ]);
        Client::create([
            'name' => 'Hasan Al Debis',
            'phone_number' => '0931133266',
            'is_company' => 1,
            'warehouse_id' => 2,
            'location_id' => 3,
        ]);
        Client::create([
            'name' => 'Ahmad Safadi',
            'phone_number' => '0939133246',
            'is_company' => 1,
            'warehouse_id' => 2,
            'location_id' => 1,
        ]);

        // WAREHOUSE3
        // CLIENTS
        Client::create([
            'name' => 'Saleh Al Halabi',
            'phone_number' => '0954987316',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 25,
        ]);
        Client::create([
            'name' => 'Suliman Hasan',
            'phone_number' => '0936489211',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 26,
        ]);
        Client::create([
            'name' => 'Abd Alrahman Al Najjar',
            'phone_number' => '',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 25,
        ]);
        Client::create([
            'name' => 'Ebrahim Al Khabaz',
            'phone_number' => '0994564821',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 24,
        ]);
        Client::create([
            'name' => 'Ali Qazaz',
            'phone_number' => '0996897321',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 24,
        ]);
        Client::create([
            'name' => 'Hasan Al Debis',
            'phone_number' => '0935698799',
            'is_company' => 0,
            'warehouse_id' => 3,
            'location_id' => 26,
        ]);
        //COMPANIES
        Client::create([
            'name' => 'Nour Al-Huda Publishing House ',
            'phone_number' => '0939133266',
            'is_company' => 1,
            'warehouse_id' => 3,
            'location_id' => 26,
        ]);
    }
}
