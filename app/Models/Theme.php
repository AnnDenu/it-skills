<?php

namespace App\Models;

use http\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/*
 * Модель тем
 * */

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
      'chapter_id',
      'name',
      'type_of_activity',
      'content',
      'document',
      'order'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($theme) {
            $lastOrder = self::max('order');
            $theme->order = $lastOrder !== null ? $lastOrder + 1 : 0;
        });
    }

    public function getDocumentUrlAttribute()
    {
        return Storage::url($this->document);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function shedule()
    {
        return $this->hasMany(Shedule::class);
    }
//    public function message()
//    {
//        return $this->hasMany(Message::class)
//    }

}
