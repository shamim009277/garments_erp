<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Administration\Module;
use App\Models\Administration\Menu;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $module = Module::where('url', 'ordermanagement')->first();

        if ($module) {
            $parentMenu = Menu::where('module_id', $module->id)
                ->where('title', 'Database')
                ->first();

            if ($parentMenu) {
                Menu::create([
                    'module_id' => $module->id,
                    'parent_id' => $parentMenu->id,
                    'menu_type' => 1,
                    'title' => 'Sample Order Programme',
                    'slug' => 'sample-order-programme',
                    'url' => 'database/sampleorderprogramme',
                    'icon' => 'list',
                    'order' => 99, // Placing it at the end
                    'is_active' => true,
                    'has_child' => false,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $module = Module::where('url', 'ordermanagement')->first();

        if ($module) {
            Menu::where('module_id', $module->id)
                ->where('slug', 'sample-order-programme')
                ->delete();
        }
    }
};
