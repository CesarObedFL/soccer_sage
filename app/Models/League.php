<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name', 
        'country', 
        'season', 
        'round', 
        'logo'
    ];

    protected $table = "leagues";

    public $timestamps = false;
}
