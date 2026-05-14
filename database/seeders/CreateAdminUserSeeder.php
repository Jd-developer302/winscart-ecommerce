<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Seeds the "Super Admin" role with all permissions and a login user.
 *
 * Login: admin@winscart.com / 12345678
 */
class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $guard = config('auth.defaults.guard', 'web');

        $superAdminRole = Role::firstOrCreate(
            ['name' => 'Super Admin', 'guard_name' => $guard],
        );

        $superAdminRole->syncPermissions(
            Permission::query()->where('guard_name', $guard)->get()
        );

        $user = User::firstOrCreate(
            ['email' => 'admin@winscart.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ],
        );

        if (! $user->hasRole('Super Admin')) {
            $user->assignRole($superAdminRole);
        }
    }
}
