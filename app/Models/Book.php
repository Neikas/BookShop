<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
       'review_id', 'user_id','title', 'description','price', 'discount', 'author_id', 'picture','approved',
    ];
    protected $perPage = 25;

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
    public function scopeDiscountedPrice($query)
    {
        return  $this->price - (($this->price / 100 ) * $this->discount ) ;
    }
    public function getAvgRatingAttribute()
    {
        return round( $this->reviews()->average('stars'), 1 );
    }
    public function getIsNewAttribute()
    {
        return $this->created_at > now()->subWeek();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest('id');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
