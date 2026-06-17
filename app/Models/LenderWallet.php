<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LenderWallet extends Model
{
    /** @use HasFactory<\Database\Factories\LenderWalletFactory> */
    use HasFactory;

    protected $fillable = [
        'lender_id',
        'balance',
        'total_invested',
        'total_profit',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'total_invested' => 'decimal:2',
            'total_profit' => 'decimal:2',
        ];
    }

    public function lender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function user(): BelongsTo
    {
        return $this->lender();
    }
}
