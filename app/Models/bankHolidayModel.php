<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankHolidayModel extends Model
{
    protected $table = 'bank_holidays';

    protected $fillable = [
        'title',
        'status',
        'date'
    ];
}
