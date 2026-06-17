<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMilestone extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectMilestoneFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'phase_name',
        'description',
        'target_date',
        'is_completed',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'target_date' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
