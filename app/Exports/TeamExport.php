<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Models\admTeam;

class TeamExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function sheets(): array
    {
        $team = admTeam::where('userID', session()->get('email'))->get();
        foreach($team as $t)
        {
            $sheets[] = new TemplateExport($t->name);
        }

        return $sheets;
    }
}
