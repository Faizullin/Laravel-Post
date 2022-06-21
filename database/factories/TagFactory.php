<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */

use Illuminate\Support\Str;
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $t = $this->faker->unique()->word;
        return [
            'title'=>$t,
            'slug'=>Str::slug($t),
        ];
    }
}
