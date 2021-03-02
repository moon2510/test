<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;
use App\OrderDetail;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
    	'user_id', 'status', 'price', 'note', 'date_borrow', 'date_give_back'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function orderdetail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
