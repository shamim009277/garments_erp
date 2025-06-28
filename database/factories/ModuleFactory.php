<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administration\Module;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition(): array
    {
        return [
            'name' => 'Administration',
            'slug' => 'administration',
            'url' => 'administration',
            'image' => 'modules/default.png',
            'is_active' => true,
        ];
    }
}
