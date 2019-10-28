<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Role;

class RoleMenuItemExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return (new Role())->menuItems()->get();
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
        return 'Role Menu Item';
    }
}
