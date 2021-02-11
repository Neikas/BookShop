<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message' , 'report_id', 'is_admin'
     ];
}
