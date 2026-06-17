<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'title',
        'slug',
        'tagline',
        'description',
        'location',
        'mining_type',
        'total_capital',
        'min_investment',
        'investment_type',
        'investor_share',
        'vendor_share',
        'duration_months',
        'risk_level',
        'permit_status',
        'luas_lahan',
        'status',
        'cover_image',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'total_capital' => 'decimal:2',
            'min_investment' => 'decimal:2',
            'investor_share' => 'decimal:2',
            'vendor_share' => 'decimal:2',
            'status' => 'string',
            'risk_level' => 'string',
            'investment_type' => 'string',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ProjectGallery::class, 'project_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(ProjectMilestone::class, 'project_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class, 'project_id');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ProjectFaq::class, 'project_id');
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class, 'project_id');
    }

    public function profitDistributions(): HasMany
    {
        return $this->hasMany(ProfitDistribution::class, 'project_id');
    }

    public function getCollectedCapitalAttribute(): float
    {
        return (float) $this->investments()->sum('amount');
    }

    public function getTargetCapitalAttribute(): float
    {
        return (float) $this->total_capital;
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->total_capital <= 0) return 0;
        return min(($this->collected_capital / $this->total_capital) * 100, 100);
    }
}
