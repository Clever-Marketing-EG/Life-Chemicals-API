<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'name_ar' => $this->faker->unique()->word,
            'description' => $this->faker->text,
            'description_ar' => $this->faker->text,
            'uses' => $this->faker->sentence,
            'uses_ar' => $this->faker->sentence,
            'origins' => ['hi', 'hello', 'welcome'],
            'origins_ar' => ['hi', 'hello', 'welcome'],
            'weight' => rand(0,500),
            'image_url' => $this->faker->url
        ];
    }
}
