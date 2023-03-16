<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class First extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'ROOT',
                'phone' => 'ROOT',
                'password' => bcrypt('root'),
                'role' => 'ROOT',
            ],
        ]);

        try{
            rrmdir(storage_path('app/public/products'));
        } catch (\Exception $e){
            error_log('cantnotdeletefolder'.$e->getMessage());
        }

        try{
            rrmdir(storage_path('app/public/images/uploads'));
        } catch (\Exception $e){
            error_log('cantnotdeletefolder'.$e->getMessage());
        }
    }
}
