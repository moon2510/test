<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\book;

class Category extends Model
{
    //
    protected $table = "categories";

    protected $fillable = [
    	'name',
    ];

    public function books(){
    	return $this->hasMany(book::class,'category_id','id');
    }
}
