<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * Модель разделов
 */
class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'course_id',
        'creator',
        'editor',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function creators()
    {
        return $this->belongsTo(User::class, 'creator');
    }
    public function editors()
    {
        return $this->belongsTo(User::class, 'editor');
    }
    public function theme()
    {
        return $this->hasMany(Theme::class);
    }

   public function message()
   {
       return $this->hasMany(Message::class);
   }
}
