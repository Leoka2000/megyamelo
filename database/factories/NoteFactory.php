<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'university' => $this->faker->unique()->word,
            'photo' => $this->faker->imageUrl(800, 600),
            'degree' => $this->faker->unique()->word,
            'area' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph(6),
            'cv' => 'default_value', 
            'accept' => $this->faker->boolean(),
            'linkedin' => $this->faker->unique()->url,
            'other_links' => $this->faker->text,
            'is_published' => $this->faker->boolean(),
            'heart_count' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}