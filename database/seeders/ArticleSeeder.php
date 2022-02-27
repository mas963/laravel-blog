<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i<4; $i++){
            $title = $faker->sentence(rand(3,6));
            DB::table('articles')->insert([
                    'category_id' => rand(1,8),
                    'title' => $title,
                    'content' => $faker->paragraph(rand(50,60)),
                    'image' => $faker->imageUrl(640,480, 'animals'),
                    'slug' => Str::slug($title),
                    'created_at' => $faker->dateTime('now'),
                    'updated_at' => now()
            ]);
        }
    }
}
