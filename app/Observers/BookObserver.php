<?php

namespace App\Observers;
use App\Book;
use App\Newsletter;
use App\Mail\MailNewsletter;

class bookObserver
{
    public function created(book $book)
    {
    	$emails = Newsletter::pluck('email')->toArray();
    	$data = [
    		'id' => $book->id,
    		'name' => $book->name,
    		'img' => $book->img
    	];
        
    }
}
