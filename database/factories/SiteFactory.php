<?php

namespace Database\Factories;

use App\Constants\DocumentTypes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->unique()->slug(1),
            'document_type' => $this->faker->randomElement(DocumentTypes::cases()),
            'document' => $this->faker->numerify('##########'),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
