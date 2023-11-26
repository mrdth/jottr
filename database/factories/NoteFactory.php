<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraphs(3, true),
            'parent_id' => $this->faker->randomNumber(1) > 7 ? Note::inRandomOrder()->first()?->id : null,
            'previous_id' => null,
            'next_id' => null,
            'todo_status' => $this->faker->randomNumber(1) > 7 ? 'pending' : null,
        ];
    }
}
