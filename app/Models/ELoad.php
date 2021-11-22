<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELoad extends Model
{
    use HasFactory;
    protected $table = 'eloads';
    protected $fillable = [
        'LoadAmount',
        'ProductID'
    ];
}
