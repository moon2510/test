<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Order;
use App\OrderDetail;

class Book extends Model
{
    protected $table = "books";

    protected $fillable = [
    	'name', 'img', 'author', 'published_year', 'describes', 'price', 'quantity', 'category_id'
    ];

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class, 'book_id', 'id');
    }
    
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Order(){
        return $this->belongstoMany(Order::class, 'detail_order', 'book_id', 'order_id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class)->orderBy('created_at','DESC');
    }
}
