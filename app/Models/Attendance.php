<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime: d M, Y h:i A',
    ];
}
