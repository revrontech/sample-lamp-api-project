<?php

namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $connection = 'common';
	
    protected $fillable = [
     	'title', 'title_slug', 'img', 'content', 'year'
    ]; 
}


?>