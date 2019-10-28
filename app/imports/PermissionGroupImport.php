<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use App\Models\PermissionGroup;
use Maatwebsite\Excel\Concerns\OnEachRow;

class PermissionGroupsImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        PermissionGroup::firstOrCreate(
            ['name' => $row[1]],
            [
                'name' => $row[1],
                'description' => $row[2],
            ]
        );
    }
}
