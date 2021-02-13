<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message' , 'report_id','user_id','is_admin'
     ];
     public function report(){

        return  $this->belongsTo(Report::class);
     }
     public function user()
     {
      return  $this->belongsTo(User::class);
     }
}
