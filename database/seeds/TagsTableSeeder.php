<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $php = \App\Tag::create([
            'name' => 'PHP'
        ]);
        $laravel = \App\Tag::create([
            'name' => 'Laravel'
        ]);
        $symphony = \App\Tag::create([
            'name' => 'Symphony'
        ]);
        $vue = \App\Tag::create([
            'name' => 'Vue'
        ]);

        $tags = [
            $php->id,
            $laravel->id,
            $symphony->id,
            $vue->id
        ];

        foreach(\App\Post::all() as $post) {
            shuffle($tags);
            for($i = 0; $i < rand(0, count($tags) - 1); $i++) {
                $post->tags()->attach($tags[$i]);
            }
        }
    }
}
