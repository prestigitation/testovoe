<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Администратор'
            ],
            [
                'name' => 'Пользователь'
            ],
        ];

        foreach($roles as $role) {
            Role::create([
                'name' => $role['name']
            ]);
        }
    }
}
