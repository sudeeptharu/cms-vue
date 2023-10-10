<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Link;
use App\Models\Page;
use App\Models\Post;
use App\Models\Scroller;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use App\Models\Video;
use App\Models\WebSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       $category= Category::factory()->count(3)->create();
       $post=Post::factory()->count(3)->hasAttached($category)->create();
       Link::factory()->count(30)->create();
       Page::factory()->count(30)->create();
       Scroller::factory()->count(30)->create();
       WebSetting::factory()->count(30)->create();
       Video::factory()->count(30)->create();
       Service::factory()->count(30)->create();
       Slider::factory()->count(30)->create();
       Gallery::factory(5)->has(Image::factory()->count(10))->create();
    }
}
