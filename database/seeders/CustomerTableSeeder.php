<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('customers')->truncate();
        $faker = Factory::create();
        for($i=1; $i<=5; $i++){
            DB::table('customers')->insert([
                'name'=>$faker->name(),
                'email'=>$faker->email(),
                'email_verified_at'=>Carbon::now(),
                'password'=>Hash::make('password@321'),
                'status'=>true,
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
