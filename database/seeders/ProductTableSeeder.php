<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        $faker = Factory::create();
        $sellers = User::all();
        foreach($sellers as $seller){
            for($i = 1; $i<= 10; $i++){

                for($j=1; $j<=5; $j++){
                    $images [] = $faker->imageUrl();
                }


                $name = $faker->sentence(2);
                DB::table('products')->insert([
                    'user_id'=>$seller->id,
                    'name'=>$name,
                    'slug'=>Str::slug($name),
                    'stock_qty'=>$faker->numberBetween(10, 50),
                    'price_of_unit'=>$faker->numberBetween(10, 50),
                    'summary'=>$faker->paragraph(3),
                    'description'=>$faker->paragraph(5),
                    'image'=>$faker->imageUrl(),
                    'images'=>implode(',', $images),
                    'status'=>true,
                ]);
            }
        }
        Schema::enableForeignKeyConstraints();
    }
}
