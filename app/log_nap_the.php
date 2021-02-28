<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log_nap_the extends Model
{
    protected $table = 'log_nap_the';

    protected $fillable = [
    	'user_id', 'pin', 'seri', 'status', 'price', 'message'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
