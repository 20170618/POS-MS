<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $primaryKey = 'DebtorID';    
    protected $table = 'debtor';
    protected $fillable = ['DebtorName','ContactNumber'];
}
