<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'description',
        'amount',
        'currency_id',
        'status',
        'gateway',
        'process_identifier',
        'expiration',
        'fields_data',
        'site_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'fields_data' => AsArrayObject::class,
        ];
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    protected function getBuyerAttribute() : array
    {
        return [
            'name'          => $this->fields_data['name'],
            'last_name'     => $this->fields_data['last_name'],
            'email'         => $this->fields_data['email'],
            'document_type'  => $this->fields_data['document_type'],
            'document'      => $this->fields_data['document'],
        ];
    }
}
