<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageContent extends Model
{
    /** @use HasFactory<\Database\Factories\LandingPageContentFactory> */
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
