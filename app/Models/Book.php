<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function publisher()
    {
        return $this->belongsTo(publisher::class);
    }
    public function authors()
    {
        return $this->belongsToMany(author::class, 'book_author');
    }
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
    public function rate()
    {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count() : 0;
    }
}