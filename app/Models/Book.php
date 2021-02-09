<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
       'review_id', 'user_id' ,'title', 'description','price','picture_url', 'discount', 'author_id', 'picture'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function genders()
    {
        return $this->hasMany(Genders::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
