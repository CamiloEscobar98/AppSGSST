<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Document_type::create([
            'type' => 'c.c',
            'info' => 'cédula de ciudadanía',
        ]);

        \App\Models\Document_type::create([
            'type' => 'c.e',
            'info' => 'cédula de extranjería',
        ]);

        \App\Models\Document_type::create([
            'type' => 't.i',
            'info' => 'tarjeta de identidad',
        ]);
    }
}
