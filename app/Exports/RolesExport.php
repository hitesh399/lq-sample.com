<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Role;
use Maatwebsite\Excel\Concerns\WithTitle;

class RolesExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Role::all();
    }

    public function map($role): array
    {
        return $role->toArray();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Roles';
    }
}
