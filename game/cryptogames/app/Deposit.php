<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Deposit extends Model
{
    //
    protected $fillable = [
        'transaction_id', 'user_id', 'gateway_name','amount','charge','net_amount','status','details','address',
    ];

    public function user(){

        return $this->belongsTo('App\User');

    }




}
