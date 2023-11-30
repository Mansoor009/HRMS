<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveRecordModel extends Model
{
    protected $table = 'leave_records';
    protected $fillable = [
        'user_id',
        'title',
        'from_leave',
        'to_leave',
        'description',
        'status',
        'leave_type',
        'no_of_days',
        'reject_reason'
    ];
}
