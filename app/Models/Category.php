<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'CategoryID';    
    protected $table = 'categories';
    protected $fillable = ['CategoryName','Description'];
}
