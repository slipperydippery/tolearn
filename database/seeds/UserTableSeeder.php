<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_maarten = new User();
        $user_maarten->name = 'Maarten de Jager';
        $user_maarten->email = 'maartendejager@gmail.com';
        $user_maarten->password = bcrypt('password');
        $user_maarten->save();
    }
}
