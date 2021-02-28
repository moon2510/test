<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Category extends Model
{
    //
    protected $table = "categories";

    protected $fillable = [
    	'name',
    ];

    public function Books(){
    	return $this->hasMany(Book::class,'category_id','id');
    }
}
