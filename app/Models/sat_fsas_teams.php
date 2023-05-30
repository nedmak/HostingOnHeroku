<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sat_fsas_teams extends Model
{
    use HasFactory;
    protected $connection = 'pgsql2';
    protected $table = 'foot_sys_fl.sat_fsas_teams';
    protected $fillable = [
        'teams_hkey',
        'load_date',
        'load_cycle_id',
        'hash_diff',
        'delete_flag',
        'name',
        'code',
        'countrty',
        'founded',
    ];
}
