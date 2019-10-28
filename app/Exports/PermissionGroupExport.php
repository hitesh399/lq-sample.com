<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\PermissionGroup;
use Maatwebsite\Excel\Concerns\WithTitle;

class PermissionGroupExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PermissionGroup::all();
    }

    public function map($permission_group): array
    {
        return $permission_group->toArray();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Permission Group';
    }
}
