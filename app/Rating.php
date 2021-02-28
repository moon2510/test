<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;

class Rating extends Model
{
    protected $table = "ratings";

    protected $fillable = [
    	'user_id', 'book_id', 'star_number', 'comment'
    ];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
