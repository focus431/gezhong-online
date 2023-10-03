<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
       
        'schedule_date',
        'day_of_week',
        'start_time',
        'end_time',
        'is_recurring',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

