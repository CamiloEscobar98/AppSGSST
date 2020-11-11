<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'name' => 'administrador'
        ]);

        \App\Models\Role::create([
            'name' => 'capacitador'
        ]);

        \App\Models\Role::create([
            'name' => 'capacitante'
        ]);
    }
}
