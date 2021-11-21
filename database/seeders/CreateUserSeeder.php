<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
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
                'UserName' => 'Admin',
                'FirstName' => 'FName',
                'LastName' => 'LName',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('miguisstore'),
                'UserType' => 'admin',

            ],
            [
                'UserName' => 'Salesperson',
                'FirstName' => 'FName',
                'LastName' => 'LName',
                'email' => 'salesperson@gmail.com',
                'password' => bcrypt('123456'),
                'UserType' => 'user',

            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
