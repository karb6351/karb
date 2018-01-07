<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'create post']);

        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);

        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create role']);

        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'create permission']);

        Permission::create(['name' => 'asign role']);
        Permission::create(['name' => 'asign permission']);

        // create roles and assign existing permissions

        // normal user
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('edit post');
        $role->givePermissionTo('create post');

        //admin which is manage the forum
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('edit post');
        $role->givePermissionTo('delete post');
        $role->givePermissionTo('create post');

        $role->givePermissionTo('edit user');
        $role->givePermissionTo('delete user');
        $role->givePermissionTo('create user');

        //superadmin which is the owner of forum
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo('edit post');
        $role->givePermissionTo('delete post');
        $role->givePermissionTo('create post');

        $role->givePermissionTo('edit role');
        $role->givePermissionTo('delete role');
        $role->givePermissionTo('create role');

        $role->givePermissionTo('edit permission');
        $role->givePermissionTo('delete permission');
        $role->givePermissionTo('create permission');

        $role->givePermissionTo('asign role');
        $role->givePermissionTo('asign permission');

    }
}
