<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sat_fsas_player_stats extends Model
{
    use HasFactory;
    protected $connection = 'pgsql2';
    protected $table = 'foot_sys_fl.sat_fsas_player_stats';
}
