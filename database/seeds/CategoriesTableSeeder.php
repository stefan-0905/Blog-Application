<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Uncategorized'
        ]);
        Category::create([
            'title' => 'Web Programming'
        ]);
        Category::create([
            'title' => 'Laravel'
        ]);
        Category::create([
            'title' => 'Dependancy Injection'
        ]);
        Category::create([
            'title' => 'Routing'
        ]);
    }
}
