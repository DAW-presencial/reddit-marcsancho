<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $comunidad = Community::factory(3)->create();
        foreach ($comunidad as $com){
            $usuario = User::factory(2)->hasAttached($com)->create();
            foreach ($usuario as $usr) {
                Post::factory(2)->for($com)->for($usr)->has(Comment::factory(3)->for($usr)->count(3))->count(2)->create();
            }
        }
    }
}
