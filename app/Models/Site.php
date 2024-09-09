<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Site extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'logo',
        'document_type',
        'site_type',
        'document',
        'category_id',
        'currency_id',
        'fields',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    protected function casts(): array
    {
        return [
            'fields' => AsArrayObject::class,
        ];
    }

    public function scopeFindBySlugOrId($query, $identifier)
    {
        return is_numeric($identifier)
            ? $query->where('id', $identifier)
            : $query->where('slug', $identifier);
    }

    public function scopeGetSitesByRole($query, User $user)
    {
        $role = $user->roles()->first();
        return $query->when($role && $role->name === 'Customer', function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        });
    }
}
