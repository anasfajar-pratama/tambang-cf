<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectGallery extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectGalleryFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image',
        'caption',
        'order',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
