<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\ApplicationMenuItem;

class ApplicationMenuItemExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ApplicationMenuItem::all();
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
        return 'Application Menu Items';
    }
}
