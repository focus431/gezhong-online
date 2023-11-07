<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassSchedule;





class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'role',
        'first_name',
        'last_name',
        'gender',
        'password',
        'email',
        'date_of_birth',
        'blood_group',
        'mobile',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'avatar_path',
        'activated',
        'activation_code',
        'google_meet_code',
        'about_me',
        'education_background',
        'youtube_link',
        'created_at',
        'updated_at',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * 獲取用戶頭像的存儲路徑
     *
     * @return string 存儲路徑
     */
    public function getAvatarPathAttribute()
    {
        // 如果模型中有一個 'avatar_path' 屬性，則使用它。
        // 否則，返回預設的頭像路徑。
        return $this->attributes['avatar_path'] ?? 'default-avatar.jpg';
    }


    // 在 User 模型中
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'mentor_courses', 'user_id', 'course_id');
    }




    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
}
