<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PermissionDataExport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new PermissionsExport();
        $sheets[] = new PermissionGroupExport();
        $sheets[] = new PermissionFieldExport();
        $sheets[] = new RolesExport();
        $sheets[] = new RolePermissionExport();
        $sheets[] = new RolePermissionFieldExport();
        $sheets[] = new ApplicationMenuExport();
        $sheets[] = new ApplicationMenuItemExport();
        $sheets[] = new RoleMenuItemExport();

        return $sheets;
    }
}
