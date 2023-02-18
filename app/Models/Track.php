<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $track_name
 */
class Track extends Model
{
    use HasFactory;

    /**
     * @property string $track_name
     */
    protected $fillable = [
        'track_name',
        'track',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'track' => 'object',
    ];

    /**
     * @return Attribute
     */
    protected function track(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
