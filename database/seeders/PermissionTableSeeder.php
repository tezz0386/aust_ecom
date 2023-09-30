<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        $permissions = [
            [
                'col_name'=>'User Management',
                'name'=>'View User',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'User Management',
                'name'=>'Create User',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'User Management',
                'name'=>'Edit User',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'User Management',
                'name'=>'Delete User',
                'guard_name'=>'web',
            ],



            [
                'col_name'=>'Role Management',
                'name'=>'View Role',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Role Management',
                'name'=>'Create Role',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Role Management',
                'name'=>'Edit Role',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Role Management',
                'name'=>'Delete Role',
                'guard_name'=>'web',
            ],



            [
                'col_name'=>'Permission Management',
                'name'=>'View Permission',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Permission Management',
                'name'=>'Create Permission',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Permission Management',
                'name'=>'Edit Permission',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Permission Management',
                'name'=>'Delete Permission',
                'guard_name'=>'web',
            ],



            [
                'col_name'=>'Sub Agent Management',
                'name'=>'View Sub Agent',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Sub Agent Management',
                'name'=>'Create Sub Agent',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Sub Agent Management',
                'name'=>'Edit Sub Agent',
                'guard_name'=>'web',
            ],
            [
                'col_name'=>'Sub Agent Management',
                'name'=>'Delete Sub Agent',
                'guard_name'=>'web',
            ],
           
        ];
        DB::table('permissions')->insert($permissions);
        Schema::enableForeignKeyConstraints();
    }
}
