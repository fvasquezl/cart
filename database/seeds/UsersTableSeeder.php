<?php

use App\User;
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
        factory(User::class)->create([
           'name' => 'fvasquez',
           'first_name' => 'Faustino',
           'last_name' => 'Vasquez',
           'role' => 'admin',
           'email' => 'admin@local.com',
        ]);

        factory(User::class)->create([
           'name' => 'svasquez',
           'first_name' => 'Sebastian',
           'last_name' => 'Vasquez',
           'email' => 'client@local.com',
        ]);
    }
}
