<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;

/**
 * @method static create(array $array)
 */

/*
 * Категории
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
