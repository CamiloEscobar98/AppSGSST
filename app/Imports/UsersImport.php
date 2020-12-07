<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersImport implements ToModel, WithHeadingRow, WithEvents, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::updateOrCreate([
            'name' => $row['nombres'],
            'lastname' => $row['apellidos'],
            'email' => $row['email'],
            'document_id' => \App\Models\Document::updateOrCreate([
                'document' => $row['documento'],
                'document_type_id' => \App\Models\Document_type::where('type', $row['tipodocumento'])->first()->id,
            ])->id,
            'password' => bcrypt('1234')
        ]);

        $role = \App\Models\Role::where('name', 'capacitante')->first();
        $user->roles()->attach($role);
        $user->image()->create([
            'image' => 'default.png',
            'url' => 'storage/images/profiles'
        ]);
    }

    public function uniqueBy()
    {
        return 'email';
    }

    public function registerEvents(): array
    {
        return [];
    }

    public static function afterSheet(AfterSheet $event)
    {
        // 
    }
}
