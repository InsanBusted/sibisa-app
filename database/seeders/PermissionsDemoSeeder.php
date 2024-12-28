<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'edit']);
        // Permission::create(['name' => 'delete']);
        // Permission::create(['name' => 'update']);
        // Permission::create(['name' => 'create']);

        // create roles and assign existing permissions
        // $role1 = Role::create(['name' => 'dosen']);
        // $role1->givePermissionTo('edit');
        // $role1->givePermissionTo('delete');
        // $role1->givePermissionTo('update');
        // $role1->givePermissionTo('create');

        // $role2 = Role::create(['name' => 'mahasiswa']);
        // $role2->givePermissionTo('edit');
        // $role2->givePermissionTo('delete');
        // $role2->givePermissionTo('update');
        // $role2->givePermissionTo('create');

        // $role3 = Role::create(['name' => 'admin']);
        // // gets all permissions via Gate::before rule; see AuthServiceProvider

        // // create demo users
        $user = User::factory()->create([
            'name' => 'bijer.sKom',
            'email' => 'dosenbijer@gmail.com',
        ]);
        $user->assignRole('dosen');
        $user = User::factory()->create([
            'name' => 'rafli.sKom',
            'email' => 'dosenrafli@gmail.com',
        ]);
        $user->assignRole('dosen');
        $user = User::factory()->create([
            'name' => 'khalik.sKom',
            'email' => 'dosenkhalik@gmail.com',
        ]);
        $user->assignRole('dosen');

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Insan Kamil',
        //     'email' => 'mahasiswa@gmail.com',
        // ]);
        // $user->assignRole($role2);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        // ]);
        // $user->assignRole($role3);
    }
}
