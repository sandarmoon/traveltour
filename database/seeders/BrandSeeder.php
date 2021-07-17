<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrray=['BMW', 'Ford', 'General Motors (GM)', 'Hyundai', 'KIA', 'Mercedes Benz', 'Nissan', 'Suzuki', 'TATA', 'Toyota'];

        foreach($arrray as $a){
            Brand::create([
                'name'=>$a
            ]);
        }
    }
}
