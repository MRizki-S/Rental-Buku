<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'book_code', 'title', 'cover', 'slug'
    ];

    // sluggable    (harus menambahkan  use Sluggable;)
    public function sluggable(): array
    {
        return [
            'slug' => [ // sumber yang mau dijadikan slug -> name
                'source' => 'title'
            ]
        ];
    }


    public function categories() 
    {      
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
}
