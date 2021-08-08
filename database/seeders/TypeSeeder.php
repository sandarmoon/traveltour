<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=['Hotel','CarTransport'];
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
    }
}
