<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => fake()->sentence(1) ,
            'descr' => fake()->paragraph(20) ,
            'priority' => NULL ,
            'project_id' => fake()->numberBetween(1,20) ,

            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
