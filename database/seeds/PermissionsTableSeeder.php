<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating permissions

        //crud posts
        $crudPost = \App\Permission::create([
            'name' => 'crud-post'
        ]);
        //update others posts
        $updateOthersPost = \App\Permission::create([
            'name' => 'update-others-post'
        ]);
        //delete others posts
        $deleteOthersPost = \App\Permission::create([
            'name' => 'delete-others-post'
        ]);
        //crud categories
        $crudCategories = \App\Permission::create([
            'name' => 'crud-category'
        ]);
        //crud users
        $crudUsers = \App\Permission::create([
            'name' => 'crud-user'
        ]);
        
        // Attaching permissions to roles
        // $admin = \App\Role::findOrFail(1);
        $admin = \App\Role::where('name', 'admin')->first();
        // $editor = \App\Role::findOrFail(2);
        $editor = \App\Role::where('name', 'editor')->first();
        // $author = \App\Role::findOrFail(3);
        $author = \App\Role::where('name', 'author')->first();


        $admin->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories, $crudUsers]);
        $editor->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategories]);
        $author->attachPermission($crudPost);
        
    }
}
