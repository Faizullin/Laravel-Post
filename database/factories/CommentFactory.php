<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message'=>$this->faker->sentence,
            'user_id'=>\App\Models\User::all()->random()->id,
            'post_id'=>\App\Models\Post::all()->random()->id,
            'parent_id'=>null,
        ];
    }
    public function withParent($count = 1)
    {
        for ($i=0; $i < $count; $i++) { 
            $data = [
                'message'=>$this->faker->sentence,
                'user_id'=>\App\Models\User::all()->random()->id,
                'post_id'=>\App\Models\Post::all()->random()->id,
                'parent_id'=>\App\Models\Comment::whereNull('parent_id',null)->get()->random()->id,
            ];
            \App\Models\Comment::create($data);
        }
        
        return [];
    }
}
