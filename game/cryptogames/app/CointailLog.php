<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CointailLog extends Model
{
    //
    protected $table = 'cointail_logs';

    protected $fillable = ['user_id','amount','game','made_date','best'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
