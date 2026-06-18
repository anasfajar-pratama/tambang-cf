<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topup extends Model
{
    /** @use HasFactory<\Database\Factories\TopupFactory> */
    use HasFactory;

    protected $fillable = [
        'lender_id',
        'amount',
        'bank_name',
        'account_holder',
        'proof_image',
        'transfered_at',
        'status',
        'admin_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
            'amount' => 'decimal:2',
            'transfered_at' => 'datetime',
        ];
    }

    public function lender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
