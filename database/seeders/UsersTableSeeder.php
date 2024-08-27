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
                'email' => 'sa354127@gmail.com',
                'password' => Hash::make('qwe123'),
                'is_admin' => true,
                'foto' => null,
            ],
            [
                'name' => 'admin2',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'foto' => null,
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
