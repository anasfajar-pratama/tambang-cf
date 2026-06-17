<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFaq extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFaqFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'question',
        'answer',
        'order',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
