<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=["Hakkımızda","Kariyer","Vizyonumuz","Misyonumuz"];
        $count=0;
        foreach ($pages as $page){
            $count++;
            DB::table("pages")->insert([
                "title"=>$page,
                "slug"=>Str::slug($page),
                "image"=>"https://miro.medium.com/max/1400/1*_GZO1oEtSkFY405QQK02VA.jpeg",
                "content"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo ipsam quo iusto commodi, quisquam voluptatem modi itaque deserunt officiis voluptas enim exercitationem aut quis ducimus quod earum. Animi, dolor aut!",
                "order"=>$count,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
