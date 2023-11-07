<?php

// app/Models/Blog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // 指定模型關聯的資料表名稱

    // 可以被批量賦值的屬性
    protected $fillable = [
        'name',
        'image',
        'category',
        'sub_category',
        'description',
        'status',
    ];

    // 如果你有自定義的日期字段，你可以在這裡指定
    protected $dates = [
        'created_at',
        'updated_at',
        // 你的其他日期字段
    ];

    // 這裡可以定義與其他模型的關聯，例如：
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}

