<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\admPlayer;

class PlayerImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function model(array $row)
    {
        return new admPlayer([
            'name' => $row['name'],
            'lastname' => $row['last_name'],
            'age' => $row['age'],
            'number' => $row['number'],
            'position' => $row['position'],
            'email' => $row['email'],
            'teamID' => $this->id,
            'userID' => session()->get('email'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'number' => 'required|integer',
            'position' => 'required|in:attacker,goalkeeper,midfielder,defender,Attacker,Goalkeeper,Midfielder,Defender',
        ];
    }
}
