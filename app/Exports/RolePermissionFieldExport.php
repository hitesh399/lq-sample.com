<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\RolePermissionField;

class RolePermissionFieldExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RolePermissionField::all();
    }

    public function map($permission): array
    {
        return $permission->toArray();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Role Permissions Field';
    }
}
