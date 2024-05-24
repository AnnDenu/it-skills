<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Модель задания которое загружает пользователь
 * */

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'content',
        'user_id',
        'theme_id',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
