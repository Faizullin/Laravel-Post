<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\User::factory()->create([
            'name'=>'admin','email'=>'admin@mail.ru',
            'role'=>1,'password'=>Hash::make('12344321'),
            'remember_token' => Str::random(10),'email_verified_at' => now(),
        ]);
        \App\Models\Tag::factory(8)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Post::factory(14)->create();
        \App\Models\PostTag::factory(6)->create();
        \App\Models\Comment::factory(20)->create();
        \App\Models\Comment::factory()->withParent(18);
    }
}
