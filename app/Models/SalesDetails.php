<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{    
    
    protected $table = 'salesdetails';
    protected $fillable = ['SalesID','ProductID','Quantity','LoadAmount'];
}
