<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class First extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'ROOT',
                'phone' => 'ROOT',
                'password' => bcrypt('root'),
            ],
        ]);

        DB::table('saleoffs')->insert([
            [
                'name' => 'NONE',
                'amount' => 0,
                'percent' => 0,
                'contenturl' => '',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => null,
                'imageurl' => ''
            ],
        ]);

        try{
            rrmdir("storage_path('app/public/saleoff')");
        } catch (\Exception $e){
            error_log('cantnotdeletefolder'.$e->getMessage());
        }

        try{
            rrmdir("storage_path('app/public/products')");
        } catch (\Exception $e){
            error_log('cantnotdeletefolder'.$e->getMessage());
        }
    }
}
