<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *    protected $fillable = [
     * @return array
     */
    public function definition()
    {
        return [
            'review_id' => null,
            'user_id' => 1,
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'price' => 12.99,
            'discount' => 0,
            'picture_url' => 10,

        ];
    }
}
