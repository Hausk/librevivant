<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'year',
        'slug',
        'pinned_image_id',
    ];

    public function images(): HasMany {
        return $this->hasMany(Image::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function pinnedImage(): BelongsTo {
        return $this->belongsTo(Image::class, 'pinned_image_id');
    }
}
