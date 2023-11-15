<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'punch_status',
    ];

    // public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime: d M, Y h:i A',
    ];

}
