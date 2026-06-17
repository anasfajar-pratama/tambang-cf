<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    /** @use HasFactory<\Database\Factories\InvestmentFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'lender_id',
        'amount',
        'invested_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'invested_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function lender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function profitDistributions(): HasMany
    {
        return $this->hasMany(ProfitDistribution::class, 'investment_id');
    }
}
