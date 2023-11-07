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
        'status',
        'mentee_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   // 与 'mentor' 关联的方法，这假设您有一个 'user_id' 外键在 'class_schedules' 表中
   public function mentor()
   {
       return $this->belongsTo(User::class, 'user_id');
   }

   // 与 'mentee' 关联的方法，这假设您有一个 'mentee_id' 外键在 'class_schedules' 表中
   public function mentee()
   {
       return $this->belongsTo(User::class, 'mentee_id');
   }
}

