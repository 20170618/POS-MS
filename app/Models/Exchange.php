<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{  
    protected $table = 'exchange';
    protected $fillable = ['SalesID','OldProductID','NewProductID','Quantity','Status','Reason'];
}
