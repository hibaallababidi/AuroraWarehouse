<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$path = 'https://aurorawarehousetestapi.000webhostapp.com/photos/';
        //$path = 'http://127.0.0.1:8000/photos/';
        $path = '/photos/';
        $extension = '.jpg';
        //$path = public_path();
        DB::table('sub_categories')
            ->insert([
                ['sub_category'=>'بلوزات','category_id'=>1,'photo_path'=>$path.'بلوزات'.$extension],
                ['sub_category'=>'بنطال','category_id'=>1,'photo_path'=>$path.'بنطال'.$extension],
                ['sub_category'=>'قطنيات','category_id'=>1,'photo_path'=>$path.'قطنيات'.$extension],
                ['sub_category'=>'حجابات','category_id'=>1,'photo_path'=>$path.'حجابات'.$extension],
                ['sub_category'=>'جواكيت','category_id'=>1,'photo_path'=>$path.'جواكيت'.'.png'],
                ['sub_category'=>'طواقي','category_id'=>1,'photo_path'=>$path.'طواقي'.$extension],
                ['sub_category'=>'جوارب','category_id'=>1,'photo_path'=>$path.'جوارب'.$extension],
                ['sub_category'=>'كفوف','category_id'=>1,'photo_path'=>$path.'كفوف'.$extension],
                ['sub_category'=>'قمصان','category_id'=>1,'photo_path'=>$path.'قمصان'.$extension],
                ['sub_category'=>'مانطو','category_id'=>1,'photo_path'=>$path.'مانطو'.$extension],
                ['sub_category'=>'أحذية','category_id'=>1,'photo_path'=>$path.'احذية'.$extension],
                ['sub_category'=>'بجامات','category_id'=>1,'photo_path'=>$path.'بجامات'.$extension],

                ['sub_category'=>'خضراوات','category_id'=>2,'photo_path'=>$path.'خضراوات'.$extension],
                ['sub_category'=>'معلبات','category_id'=>2,'photo_path'=>$path.'معلبات'.$extension],
                ['sub_category'=>'فواكه','category_id'=>2,'photo_path'=>$path.'فواكه'.$extension],
                ['sub_category'=>'حمضيات','category_id'=>2,'photo_path'=>$path.'حمضيات'.$extension],
                ['sub_category'=>'توابل','category_id'=>2,'photo_path'=>$path.'توابل'.$extension],
                ['sub_category'=>' حبوب غذائية','category_id'=>2,'photo_path'=>$path.'حبوبغذائية'.$extension],
                ['sub_category'=>'مكسرات','category_id'=>2,'photo_path'=>$path.'مكسرات'.$extension],
                ['sub_category'=>'موالح','category_id'=>2,'photo_path'=>$path.'موالح'.$extension],
                ['sub_category'=>'مشروبات','category_id'=>2,'photo_path'=>$path.'مشروبات'.$extension],
                ['sub_category'=>'أجبان وألبان','category_id'=>2,'photo_path'=>$path.'أجبانوألبان'.$extension],
                ['sub_category'=>'لحوم','category_id'=>2,'photo_path'=>$path.'لحوم'.$extension],
                ['sub_category'=>'زيوت','category_id'=>2,'photo_path'=>$path.'زيوت'.$extension],
                ['sub_category'=>'بسكويت','category_id'=>2,'photo_path'=>$path.'بسكويت'.$extension],
                ['sub_category'=>'شوكولا','category_id'=>2,'photo_path'=>$path.'شوكولا'.$extension],

                ['sub_category'=>'قطع سيارات','category_id'=>3,'photo_path'=>$path.'قطعسيارت'.$extension],
                ['sub_category'=>'مواد بناء','category_id'=>3,'photo_path'=>$path.'مواد_بناء'.$extension],
                ['sub_category'=>'معدات كهربائية','category_id'=>3,'photo_path'=>$path.'معداتكهربائية'.$extension],
                ['sub_category'=>'معدات ثقيلة','category_id'=>3,'photo_path'=>$path.'معداتثقيلة'.$extension],

                ['sub_category'=>'شراب طبي','category_id'=>4,'photo_path'=>$path.'شرابطبي'.$extension],
                ['sub_category'=>'حبوب أدوية','category_id'=>4,'photo_path'=>$path.'حبوبأدوية'.$extension],
                ['sub_category'=>'إبر','category_id'=>4,'photo_path'=>$path.'إبر'.$extension],
                ['sub_category'=>'بخاخات','category_id'=>4,'photo_path'=>$path.'بخاخات'.$extension],
                ['sub_category'=>'لصقات طبية','category_id'=>4,'photo_path'=>$path.'لصاقاتطبية'.$extension],
                ['sub_category'=>'قطرات','category_id'=>4,'photo_path'=>$path.'قطرات'.$extension],
                ['sub_category'=>'كريمات','category_id'=>4,'photo_path'=>$path.'كريمات'.$extension],
                ['sub_category'=>'معقمات','category_id'=>4,'photo_path'=>$path.'معقمات'.$extension],
                ['sub_category'=>'عناية بالبشرة','category_id'=>4,'photo_path'=>$path.'عنايةبالبشرة'.$extension],
                ['sub_category'=>'عناية بالشعر','category_id'=>4,'photo_path'=>$path.'عنايةبالشعر'.$extension],
                ['sub_category'=>'مواد خاصة بالأطفال','category_id'=>4,'photo_path'=>$path.'موادأطفال'.$extension],

                ['sub_category'=>'كتب علمية','category_id'=>5,'photo_path'=>$path.'علمية'.$extension],
                ['sub_category'=>'كتب ثقافية','category_id'=>5,'photo_path'=>$path.'ثقافية'.$extension],
                ['sub_category'=>'كتب تنمية','category_id'=>5,'photo_path'=>$path.'تنمية'.$extension],
                ['sub_category'=>'كتب تاريخية','category_id'=>5,'photo_path'=>$path.'تاريخية'.$extension],
                ['sub_category'=>'كتب دراسية','category_id'=>5,'photo_path'=>$path.'دراسية'.$extension],
                ['sub_category'=>'روايات','category_id'=>5,'photo_path'=>$path.'روايات'.$extension],
                ['sub_category'=>'قصص أطفال','category_id'=>5,'photo_path'=>$path.'أطفال'.$extension],
                ['sub_category'=>'كتب دينية','category_id'=>5,'photo_path'=>$path.'دينية'.$extension],
                ['sub_category'=>'كتب رياضية','category_id'=>5,'photo_path'=>$path.'رياضية'.$extension],
                ['sub_category'=>'كتب تربية','category_id'=>5,'photo_path'=>$path.'تربية'.$extension],
                ['sub_category'=>'كتب فنية','category_id'=>5,'photo_path'=>$path.'فنية'.$extension],

            ]);
    }
}
