<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('qwe123'),
                'is_admin' => true,
                'foto' => null,
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('qwe123'),
                'is_admin' => true,
                'foto' => null,
            ],
            [
                'name' => 'admin3',
                'email' => 'admin3@gmail.com',
                'password' => Hash::make('qwe123'),
                'is_admin' => true,
                'foto' => null,
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
