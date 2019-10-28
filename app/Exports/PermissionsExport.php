<?php

namespace App\Exports;

use App\Models\Permission;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class PermissionsExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Permission::all();
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
        return 'Permissions';
    }
}
