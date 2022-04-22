<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\SpatialBuilder;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @property Point $location
 * @method static SpatialBuilder query()
 */
class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if ($this->location === null) {
            $this->location = new Point(51.5032973, -0.1195537);
        }
    }

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }
}
