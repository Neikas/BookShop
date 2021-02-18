<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $perPage = 20;

    protected $fillable = [
        'stars', 'comment' ,'book_id','user_id', 'author'
     ];


}
