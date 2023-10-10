<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0;$i<30;$i++){
            $post = new Post();
            $post->title = $faker->title;
            $post->subtitle = $faker->title;
            $post->excerpt = $faker->title;
            $post->description = $faker->title();
            $post->draft = $faker->title;
            $post->image = $faker->image;
            $post->quote = $faker->title;
            $post->save();
        }
    }
}
