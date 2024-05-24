<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Модель сообщений
 * */
class Message extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'time', 'content', 'chat_id', 'user_id'];

    public const STATUSES = [
        0 => 'Новое сообщение',
        1 => 'Прочитано',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
