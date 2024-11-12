<?php

namespace Database\Seeders;

use App\Models\WarehouseProducts;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //WAREHOUSE 1
        WarehouseProducts::create([
            'product_name' => 'Unadol',
            'total_quantity' => 50,
            'min_quantity' => 10,
            'subcategory_id' => 32,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Coronasyl',
            'total_quantity' => 75,
            'min_quantity' => 5,
            'subcategory_id' => 32,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Kapedix',
            'total_quantity' => 30,
            'min_quantity' => 10,
            'subcategory_id' => 32,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Motin',
            'total_quantity' => 35,
            'min_quantity' => 10,
            'subcategory_id' => 32,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Virax',
            'total_quantity' => 43,
            'min_quantity' => 5,
            'subcategory_id' => 37,
            'warehouse_id' => 1,
            'company_id' => 19
        ]);
        WarehouseProducts::create([
            'product_name' => 'neutro DERMA',
            'total_quantity' => 50,
            'min_quantity' => 10,
            'subcategory_id' => 37,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Triderm',
            'total_quantity' => 50,
            'min_quantity' => 5,
            'subcategory_id' => 37,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Mytosyl',
            'total_quantity' => 25,
            'min_quantity' => 10,
            'subcategory_id' => 37,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Toplixel',
            'total_quantity' => 70,
            'min_quantity' => 5,
            'subcategory_id' => 31,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Thymogel',
            'total_quantity' => 65,
            'min_quantity' => 10,
            'subcategory_id' => 31,
            'warehouse_id' => 1,
            'company_id' => 19,
        ]);

        //WAREHOUSE 2
        WarehouseProducts::create([
            'product_name' => 'Tomato',
            'total_quantity' => 50,
            'total_weight' => 150,
            'min_quantity' => 10,
            'subcategory_id' => 13,
            'warehouse_id' => 2,
            'company_id' => 20,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Cucumber',
            'total_quantity' => 60,
            'total_weight' => 60,
            'min_quantity' => 20,
            'subcategory_id' => 13,
            'warehouse_id' => 2,
            'company_id' => 20,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Apple',
            'total_quantity' => 40,
            'total_weight' => 80,
            'min_quantity' => 15,
            'subcategory_id' => 15,
            'warehouse_id' => 2,
            'company_id' => 21,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Ginger',
            'total_quantity' => 20,
            'total_weight' => 100,
            'min_quantity' => 5,
            'subcategory_id' => 17,
            'warehouse_id' => 2,
            'company_id' => 22,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Cumin',
            'total_quantity' => 15,
            'total_weight' => 60,
            'min_quantity' => 10,
            'subcategory_id' => 17,
            'warehouse_id' => 2,
            'company_id' => 22,
        ]);
        WarehouseProducts::create([
            'product_name' => 'Black Pepper',
            'total_quantity' => 35,
            'total_weight' => 35,
            'min_quantity' => 15,
            'subcategory_id' => 17,
            'warehouse_id' => 2,
            'company_id' => 22,
        ]);

        //WAREHOUSE 3
        WarehouseProducts::create([
            'product_name' => 'ممنوع الضحك',
            'total_quantity' => 20,
            'min_quantity' => 2,
            'subcategory_id' => 47,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'أرض زيكولا',
            'total_quantity' => 13,
            'min_quantity' => 2,
            'subcategory_id' => 47,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'أنتخريستوس',
            'total_quantity' => 43,
            'min_quantity' => 2,
            'subcategory_id' => 47,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'الفراسة',
            'total_quantity' => 35,
            'min_quantity' => 2,
            'subcategory_id' => 44,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'تحليل الشخصية',
            'total_quantity' => 40,
            'min_quantity' => 2,
            'subcategory_id' => 44,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'المثابرة',
            'total_quantity' => 50,
            'min_quantity' => 2,
            'subcategory_id' => 48,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
        WarehouseProducts::create([
            'product_name' => 'حفل المدرسة',
            'total_quantity' => 45,
            'min_quantity' => 2,
            'subcategory_id' => 48,
            'warehouse_id' => 3,
            'company_id' => 23,
        ]);
    }
}
