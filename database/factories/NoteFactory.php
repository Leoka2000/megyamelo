<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->id,
            'user_id' => User::factory(),
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'university' => $this->faker->unique()->word,
        'photo' => $this->faker->imageUrl(800, 600),
        'degree' => $this->faker->unique()->word,
        'area' => $this->faker->unique()->word,
        'description' => $this->faker->paragraph(6),
        'cv' => $this->faker->unique()->fileUrl(),
        'accept' => $this->faker->boolean(),
        'linkedin' => $this->faker->unique()->url,
        'send_date' => $this->faker->date(),
        'is_published' => $this->faker->boolean(),
        'heart_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
