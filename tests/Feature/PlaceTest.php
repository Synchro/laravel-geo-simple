<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\Place2;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_location()
    {
        $testPlace = Place::create([
            'name'     => 'somewhere',
            'location' => new Point(20, 20),
        ]);
        //Retrieve a fresh instance of what we just created from the DB
        $testPlace2 = Place::find($testPlace->id);

        //This fails because the constructor sees a null value and generates a default
        //which is not the same as the value we just stored
        self::assertEquals($testPlace, $testPlace2);

        //This fails with this error:
        //TypeError : MatanYadaev\EloquentSpatial\Objects\Geometry::fromWkb():
        //Argument #1 ($wkb) must be of type string, Illuminate\Database\Query\Expression given
        self::assertEquals($testPlace->location, $testPlace2->location);

        //Test variant that doesn't have a constructor to set a default value
        //This fails in Nova because the field is for some reason left null even though it has a default value
        //This is the reason I added the constructor top the version above, though that fails for other reasons
        $testPlace = Place2::create([
            'name'     => 'somewhere else',
            'location' => new Point(30, 30),
        ]);
        $testPlace2 = Place2::find($testPlace->id);

        //This fails because the point value is not decoded
        //This also causes Nova to fail because the WKB value can't be expressed in JSON directly
        self::assertEquals($testPlace, $testPlace2);

        //This passes!
        self::assertEquals($testPlace->location, $testPlace2->location);
    }
}
