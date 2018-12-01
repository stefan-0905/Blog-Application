<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(rand(5, 12));
    return [
        /**
         * Generating random number between 1 and 3 because we are seeding 3 users
         */
        'author_id' => rand(1, 3),
        'title' => $title,
        // 'slug' => str_slug($title),
        'body' => $faker->paragraphs(rand(10, 15), true),
        /**
         * Randomizing if it has an image
         */
        'image' => rand(0, 1) == 1 ? 'Post_Image_'.rand(1, 5).'.jpg' : NULL,
        /**
         * Randomizing if post is published or not
         */
        'published_at' => rand(0, 1) == 1 ? now() : NULL,
        /**
         * Generating random number between 1 and 4 because we are seeding 4 categories
         */
        'category_id' => rand(1, 4) 
    ];
});
