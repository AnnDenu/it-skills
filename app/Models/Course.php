<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
 * Модель курсов
 * */

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category_id', 'user_id', 'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }
    public function favourites()
    {
        return $this->hasMany(Favorite::class);
    }

}
