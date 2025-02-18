<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'currency_id',
        'document',
        'document_type'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
