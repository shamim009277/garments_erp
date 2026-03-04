<?php

use Illuminate\Database\Migrations\Migration;
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
                $existingMenu = Menu::where('module_id', $module->id)
                    ->where('parent_id', $parentMenu->id)
                    ->where('slug', 'bom-setup')
                    ->first();

                if (!$existingMenu) {
                    Menu::create([
                        'module_id' => $module->id,
                        'parent_id' => $parentMenu->id,
                        'menu_type' => 1,
                        'title' => 'BOM Setup',
                        'slug' => 'bom-setup',
                        'url' => 'setup/bomsetups',
                        'icon' => 'list',
                        'order' => 110,
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
                ->where('slug', 'bom-setup')
                ->delete();
        }
    }
};
