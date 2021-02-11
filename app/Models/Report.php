<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id' , 'user_id', 'report_text'
     ];
    public function reportMessage()
    {
        $this->hasMany(ReportMessage::class);
    }
}
