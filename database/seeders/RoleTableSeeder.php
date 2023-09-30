<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        $roles = [
            [
                'name'=>'Admin',
                'guard_name'=>'web',
            ],
            [
                'name'=>'Seller',
                'guard_name'=>'web',
            ],
        ];
        DB::table('roles')->insert($roles);
        Schema::enableForeignKeyConstraints();
    }
}
