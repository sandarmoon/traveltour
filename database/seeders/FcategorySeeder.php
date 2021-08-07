<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fcategory;

class FcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=['Bathroom','Food & Drink','General Services','Bedroom','Media & Technology'];

        foreach($array as $a){
            Fcategory::create([
                'name'=>$a,
                'type_id'=>1
            ]);
        }
    }
}
