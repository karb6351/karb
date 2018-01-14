<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserActive as UserActive;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();

        $users = User::all();
        foreach ($users as $user){
            if (!$user->hasAnyRole('user')){
                $user->assignRole('user');
            }
            $active = array(
                'user_id' => $user->id,
                'isActive' => 1 ,
                'isBan' => 0 ,
                'token' => md5(microtime()),
                );
            UserActive::create($active);
        }
    }
}
