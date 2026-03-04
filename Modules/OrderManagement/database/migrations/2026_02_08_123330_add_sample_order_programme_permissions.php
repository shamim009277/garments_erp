<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Administration\Menu;
use App\Models\Administration\Module;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $module = Module::where('url', 'ordermanagement')->first();
        $menu = Menu::where('slug', 'sample-order-programme')->first();

        if ($module && $menu) {
            $permissions = [
                'sampleorderprogramme.view',
                'sampleorderprogramme.create',
                'sampleorderprogramme.edit',
                'sampleorderprogramme.delete',
            ];

            foreach ($permissions as $permName) {
                $permission = Permission::firstOrCreate([
                    'name' => $permName,
                    'guard_name' => 'web',
                    'module_id' => $module->id,
                    'menu_id' => $menu->id,
                ]);

                // Assign to Super Admin
                $role = Role::where('name', 'Super Admin')->first();
                if ($role) {
                    $role->givePermissionTo($permission);
                }
                
                // Assign to Admin
                $adminRole = Role::where('name', 'Admin')->first();
                if ($adminRole) {
                    $adminRole->givePermissionTo($permission);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $permissions = [
            'sampleorderprogramme.view',
            'sampleorderprogramme.create',
            'sampleorderprogramme.edit',
            'sampleorderprogramme.delete',
        ];

        Permission::whereIn('name', $permissions)->delete();
    }
};
