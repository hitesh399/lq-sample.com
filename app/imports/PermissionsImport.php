<?php

namespace App\Imports;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class PermissionsImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $permission_group = $row[4] ? PermissionGroup::where('name', $row[4])->first() : null;

        $permission = Permission::updateOrCreate(
            [
                'name' => $row[1],
            ],
            [
                'title' => $row[2] ? $row[2] : '',
                'is_public' => $row[3],
                'encrypted' => $row[5] ? json_decode($row[5]) : null,
                'permission_group_id' => $permission_group ? $permission_group->id : null,
                'description' => $row[6] ? $row[6] : '',
                'limitations' => $row[7] ? json_decode($row[7], true) : null,
                'client_ids' => $row[8] ? json_decode($row[8], true) : null,
                'specific_role_ids' => $row[9] ? json_decode($row[9], true) : null,
            ]
        );
    }
}
