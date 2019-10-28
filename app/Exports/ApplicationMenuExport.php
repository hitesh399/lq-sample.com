<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\ApplicationMenu;

class ApplicationMenuExport implements FromCollection, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ApplicationMenu::all();
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
        return 'Application Menu';
    }
}
