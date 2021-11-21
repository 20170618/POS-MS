<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $primaryKey = 'SalesID';    
    protected $table = 'sales';
    protected $fillable = ['PersonInCharge','SalesDateTime','ModeOfPayment','AmountDue','AmountPaid','Debtor'];
}
