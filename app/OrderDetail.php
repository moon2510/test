<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\Book;
use App\Lostbook;

class OrderDetail extends Model
{
    protected $table = 'detail_order';

    protected $fillable = [
    	'order_id', 'book_id', 'quantity', 'created_at', 'updated_at'
    ];

    public function order(){
    	return $this->belongsTo(Order::class,'order_id');
    }

    public function book(){
    	return $this->belongsTo(book::class,'book_id');
    }

    public function lostbook(){
        return $this->hasMany(Lostbook::class, 'orderdetail_id');
    }
}
