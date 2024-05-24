<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'image' => 'default.jpg', // Предполагается, что у вас есть дефолтная картинка
            'category_id' => $this->faker->numberBetween(1, 10), // Предполагается, что у вас есть 10 категорий
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
