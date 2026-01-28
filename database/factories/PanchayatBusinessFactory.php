<?php

namespace Database\Factories;

use App\Models\Panchayat;
use App\Models\PanchayatBusiness;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PanchayatBusiness>
 */
class PanchayatBusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PanchayatBusiness::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'panchayat_id' => Panchayat::factory(),
            'title' => $this->faker->company,
            'description' => $this->faker->text,
            'photo' => $this->faker->imageUrl,
            'address' => $this->faker->address,
            'status' => $this->faker->boolean,
        ];
    }
}
