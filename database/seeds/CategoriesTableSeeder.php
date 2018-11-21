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
            'title' => 'Web Programming',
            'slug' => 'web-programming'
        ]);
        Category::create([
            'title' => 'Laravel',
            'slug' => 'laravel'
        ]);
        Category::create([
            'title' => 'Dependancy Injection',
            'slug' => 'dependancy-injection'
        ]);
        Category::create([
            'title' => 'Routing',
            'slug' => 'routing'
        ]);
    }
}
