<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create data user
        $userCreate = User::create([
            'name'      => 'Rukawa',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password')
        ]);
    }
}
