<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
 * Модель избранного
 * */
class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id'];

    public $timestamps = false;
 /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
