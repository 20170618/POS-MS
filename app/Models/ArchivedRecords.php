<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedRecords extends Model
{
    use HasFactory;
    protected $table = 'ArchivedRecords';
    protected $fillable = ['SalesID'];
}
