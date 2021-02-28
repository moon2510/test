<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    protected $table = 'image_sliders';

    protected $fillable = [
    	'path', 'title', 'subtitle', 'link', 'button_title'
    ];
}
