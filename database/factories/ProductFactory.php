<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement([
            'cosmetics',
            'food and beverage',
            'laundry',
            'medicines',
            'electronics'
        ]);

        return [
            'name' => fake()->state(),
            'category' => $category,
            'description' => \fake()->text(),
            'date_and_time' => now()
        ];
    }
}
