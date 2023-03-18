<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function review(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Book::class);
    }
}
