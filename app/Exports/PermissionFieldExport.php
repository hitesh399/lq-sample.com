<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\PermissionField;
use Maatwebsite\Excel\Concerns\WithTitle;

class PermissionFieldExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PermissionField::all();
    }

    public function map($permission_field): array
    {
        return $permission_field->toArray();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Permission Fields';
    }
}
