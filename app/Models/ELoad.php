<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ELoad extends Model
{
    protected $table = 'eloads';
    protected $fillable = [
        'LoadAmount',
        'ProductID'
    ];
}
