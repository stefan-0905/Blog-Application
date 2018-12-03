<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating admin role
        $admin = \App\Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);
        // Creating editor role
        $editor = \App\Role::create([
            'name' => 'editor',
            'display_name' => 'Editor'
        ]);
        // Creating author role
        $author = \App\Role::create([
            'name' => 'author',
            'display_name' => 'Author'
        ]);

        /**
         * Attach the roles to users
         */
        // First user as admin
        $user1 = \App\User::findOrFail(1);
        $user1->attachRole($admin);

        // Second user as editor
        $user2 = \App\User::findOrFail(2);
        $user2->attachRole($editor);

        // Third user as author
        $user3 = \App\User::findOrFail(3);
        $user3->attachRole($author);
    }
}
