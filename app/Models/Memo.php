<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Memo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'tags',
    ];

    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
