<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBanner extends Model
{
    use HasFactory;

    protected $table = 'course_banner';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'is_active',
    ];
}
