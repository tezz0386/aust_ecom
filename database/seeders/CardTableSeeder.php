<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cards')->truncate();
        $faker = Factory::create();
        $customers = Customer::all();
        foreach($customers as $customer){
            DB::table('cards')->insert([
                'customer_id'=>$customer->id,
                'bank_name'=>$faker->name(),
                'card_holder_name'=>$customer->name,
                'card_number'=>Hash::make($faker->numberBetween(1111111111111111, 9999999999999999)),
                'pin'=>Hash::make($faker->numberBetween(1111, 9999)),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
