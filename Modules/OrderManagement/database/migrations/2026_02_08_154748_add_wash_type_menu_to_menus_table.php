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
                ->where('title', 'Setup')
                ->first();

            if ($parentMenu) {
                // Check if menu already exists
                $existingMenu = Menu::where('module_id', $module->id)
                    ->where('parent_id', $parentMenu->id)
                    ->where('slug', 'wash-type')
                    ->first();

                if (!$existingMenu) {
                    Menu::create([
                        'module_id' => $module->id,
                        'parent_id' => $parentMenu->id,
                        'menu_type' => 1,
                        'title' => 'Wash Type',
                        'slug' => 'wash-type',
                        'url' => 'setup/washtypes',
                        'icon' => 'list',
                        'order' => 101,
                        'is_active' => true,
                        'has_child' => false,
                    ]);
                }
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
                ->where('slug', 'wash-type')
                ->delete();
        }
    }
};
