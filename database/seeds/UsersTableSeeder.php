<?php

use App\Models\User;
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
        User::firstOrCreate([
            'name' => 'MyNet',
            'email' => 'admin@mynet.com',
            'password' => bcrypt('Mynet'),
        ]);
    }
}
