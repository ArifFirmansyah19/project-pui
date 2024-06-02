<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin1',
                'email' => 'sa354127@gmail.com',
                'password'=> bcrypt('qwe123'),
            ]
        ];
        foreach($user as $key => $value){
          User::create($value);
        }
    }
}
