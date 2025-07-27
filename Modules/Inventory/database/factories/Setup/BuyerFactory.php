<?php

namespace Modules\Inventory\Database\Factories\Setup;

use Illuminate\Database\Eloquent\Factories\Factory;

class Setup/BuyerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Inventory\Models\Setup/Buyer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

