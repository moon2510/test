<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Category extends Model
{
    //
    protected $table = "categories";

    protected $fillable
    \ = [
    	'name',
    ];

    public function books(){
    	return $this->hasMany(book::class,'category_id','id');
    }
}
