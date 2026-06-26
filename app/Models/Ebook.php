<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
            'preview_file',
            'total_pages',
            'status',
        ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

        public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }
}

