<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'match_id',
        'league_id',
        'date',
        'status',
        'home_team',
        'away_team',
        'score'
     ];

    protected $table = "games";

    public $timestamps = false;
}
