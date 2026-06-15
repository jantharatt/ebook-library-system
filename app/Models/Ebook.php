<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'publish_year',
        'category_id',
        'description',
        'keywords',
        'cover',
        'file_path',
        'total_pages',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}