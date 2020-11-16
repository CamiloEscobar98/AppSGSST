<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)
            ->create()
            ->each(function ($user) {
                $role = \App\Models\Role::find(1);
                $user->roles()->attach($role);
                $user->image()->create([
                    'image' => 'default.png',
                    'url' => 'storage/images/profiles'
                ]);
            });

        factory(App\User::class, 50)
            ->create()
            ->each(function ($user) {
                $role = \App\Models\Role::find(3);
                $user->roles()->attach($role);
                $user->image()->create([
                    'image' => 'default.png',
                    'url' => 'storage/images/profiles'
                ]);
            });

        factory(App\User::class, 5)
            ->create()
            ->each(function ($user) {
                $role = \App\Models\Role::find(2);
                $user->roles()->attach($role);
                $user->image()->create([
                    'image' => 'default.png',
                    'url' => 'storage/images/profiles'
                ]);
            });
    }
}
