<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use hasFactory;

    protected $fillable=[
        'title',
        'description',
        'image_path',
    ];
}
