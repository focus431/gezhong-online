<?php

namespace Database\Factories;

use App\Models\ClassSchedule; // 請確保這是您模型的正確命名空間
use App\Models\User;          // 請確保這是您模型的正確命名空間
use App\Models\Course;        // 請確保這是您模型的正確命名空間
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassSchedule>
 */
class ClassScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'course_id' => function () {
                return Course::factory()->create()->id;
            },
            'day_of_week' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
            'is_recurring' => $this->faker->boolean,
        ];
    }
}

