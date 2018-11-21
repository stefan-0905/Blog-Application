<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();
        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@blogapp.com',
        //     'password' => bcrypt('secret')
        // ]);
        // User::create([
        //     'name' => 'Stefan',
        //     'email' => 'stefan@blogapp.com',
        //     'password' => bcrypt('secret')
        // ]);
        // User::create([
        //     'name' => 'John',
        //     'email' => 'john@blogapp.com',
        //     'password' => bcrypt('secret')
        // ]);
    }
}
