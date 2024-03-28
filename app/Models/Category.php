<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'name','slug'
    ];

    // sluggable    (harus menambahkan  use Sluggable;)
    public function sluggable(): array
    {
        return [
            'slug' => [ // sumber yang mau dijadikan slug -> name
                'source' => 'name'
            ]
        ];
    }
}
