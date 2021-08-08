<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        
        $this->call([
              
             BrandSeeder::class,
        ]);

        Type::create([
            "name"=>"Hotel",
            "parent_id"=>null
        ]);
        Type::create([
            "name"=>"CarTransport",
            "parent_id"=>null
        ]);
        Type::create([
            "name"=>"Package",
            "parent_id"=>null
        ]);

         $array=['admin','customer','company'];
           foreach($array as $a){
             Role::create([
                'name'=>$a
             ]);
           }
    }
}
