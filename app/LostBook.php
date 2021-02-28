<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDetail;

class LostBook extends Model
{
    protected $table = 'lostbooks';

    protected $fillable = [
    	'orderdetail_id', 'price', 'note'
    ];

    public function OrderDetail(){
    	return $this->belongsTo(OrderDetail::class, 'orderdetail_id');
    }
}
