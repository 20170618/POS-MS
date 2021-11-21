<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'ProductID';    
    protected $table = 'product';
    protected $fillable = ['ProductName','Price','Category','Stock','Description'];
}
