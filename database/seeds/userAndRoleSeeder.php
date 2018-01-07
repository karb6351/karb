<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserActive;
use Spatie\Permission\Models\Role;

class userAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = new User();
        $superadmin->username = 'SuperAdmin';
        $superadmin->email = 'superadmin@test.com';
        $superadmin->password = bcrypt('superadmin');
        $superadmin->gender = 'male';
        $superadmin->save();

        $admin = new User();
        $admin->username = 'Admin';
        $admin->email = 'admin@test.com';
        $admin->password = bcrypt('admin');
        $admin->gender = 'male';
        $admin->save();

        $user = new User();
        $user->username = 'David';
        $user->email = 'david@test.com';
        $user->password = bcrypt('123456');
        $user->gender = 'male';
        $user->save();

        $superadmin->assignRole('superadmin');
        $admin->assignRole('admin');
        $user->assignRole('user');

        $superadmin_active = new UserActive();
        $superadmin_active->user_id = $superadmin->id;
        $superadmin_active->isActive = true;
        $superadmin_active->token = md5(microtime());
        $superadmin_active->save();

        $admin_active = new UserActive();
        $admin_active->user_id = $admin->id;
        $admin_active->isActive = true;
        $admin_active->token = md5(microtime());
        $admin_active->save();

        $user_active = new UserActive();
        $user_active->user_id = $user->id;
        $user_active->isActive = true;
        $user_active->token = md5(microtime());
        $user_active->save();

    }
}
