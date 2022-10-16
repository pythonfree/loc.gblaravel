<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParserNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'category',
        'pubDate',
        'image'
    ];
}
