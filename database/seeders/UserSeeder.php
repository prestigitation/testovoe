<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoleId = 1;
        $userRoleId = 2;

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role_id' => $adminRoleId,
                'password' => Hash::make('adminpwd')
            ],
            [
                'name' => 'John',
                'email' => 'john@example.com',
                'role_id' => $userRoleId,
                'password' => Hash::make('userpwd')
            ]
        ];

        foreach($users as $user) {
            $newUser = new User;
            $newUser->fill($user);
            $newUser->save();
        }
    }
}
