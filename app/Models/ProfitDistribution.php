<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfitDistribution extends Model
{
    /** @use HasFactory<\Database\Factories\ProfitDistributionFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'investment_id',
        'amount',
        'type',
        'distributed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'distributed_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function investment(): BelongsTo
    {
        return $this->belongsTo(Investment::class, 'investment_id');
    }
}
