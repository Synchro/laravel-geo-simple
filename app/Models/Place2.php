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
class Place2 extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'name',
        'location',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }
}
