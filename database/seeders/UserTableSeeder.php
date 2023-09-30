<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $users = [
            [
                'name' => 'Admin Admin',
                'slug'=>Str::slug('Admin Admin'),
                'email' => 'admin@bibekecom.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Seller Seller',
                'slug'=>Str::slug('Seller Seller'),
                'email' => 'seller@bibekecom.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Seller Second',
                'slug'=>Str::slug('Seller Second'),
                'email' => 'sellersecond@bibekecom.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Seller Third',
                'slug'=>Str::slug('Seller Third'),
                'email' => 'sellerthird@bibekecom.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $index => $u) {
            $user = User::create($u);
            $this->assignRole($index, $user);
        }
        Schema::enableForeignKeyConstraints();
    }

    private function assignRole($index, $user)
    {
        switch ($index) {
            case 0:
                $user->assignRole('Admin');
                break;
            default:
                $user->assignRole('Seller');
                break;
                break;
        }
    }
}
