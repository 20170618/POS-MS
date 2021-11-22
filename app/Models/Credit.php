<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public $timestamps = false;
    protected $table = 'credits';
    protected $fillable = [
        'SalesID',
        'BalancePayDate',
        'Debtor',
        'Balance',
        'InitialPayment'
    ];

}
