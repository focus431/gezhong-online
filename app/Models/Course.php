<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
    // 在 Course 模型中
public function mentors()
    {
        return $this->belongsToMany('App\Models\User', 'mentor_courses', 'course_id', 'user_id');
    }
}
