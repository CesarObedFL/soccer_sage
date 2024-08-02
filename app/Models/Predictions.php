<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predictions extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'winner',
        'winner_comment',
        'percents',
        'advice',
        'goals',
        'bettingclosed_prediction',
        'forebet_prediction',
        'vitisport_prediction' 
    ];

    protected $table = 'predictions';

    public $timestamps = false;
}
