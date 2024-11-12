<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //WAREHOUSE 1
        Warehouse::create([
            'warehouse_name' => 'Al Huda Warehouse',
            'location_id' => 28,
            'manager_id' => 1
        ]);
        Department::create([
            'department_name' => 'basic',
            'warehouse_id' => 1,
        ]);

        //WAREHOUSE 2
        Warehouse::create([
            'warehouse_name' => 'Barakat Warehouse',
            'location_id' => 1,
            'manager_id' => 1
        ]);
        Department::create([
            'department_name' => 'خضروات',
            'warehouse_id' => 2,
        ]);
        Department::create([
            'department_name' => 'فواكه',
            'warehouse_id' => 2,
        ]);
        Department::create([
            'department_name' => 'توابل',
            'warehouse_id' => 2,
        ]);

        //WAREHOUSE 3
        Warehouse::create([
            'warehouse_name' => 'Al Akram Warehouse',
            'location_id' => 25,
            'manager_id' => 1
        ]);
        Department::create([
            'department_name' => 'basic',
            'warehouse_id' => 3,
        ]);
    }
}
