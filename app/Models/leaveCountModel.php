<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveCountModel extends Model
{
    protected $table = 'leave_counts';
    protected $fillable = [
        'user_id',
        'sick_leave',
        'paid_leave',
        'festive_leave'
    ];
    public $timestamps = false;
}

