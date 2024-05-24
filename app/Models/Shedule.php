<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Модель расписания
 * */
class Shedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'sunrise','content', 'theme_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

}
