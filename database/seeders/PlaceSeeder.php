<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::firstOrCreate([
            'name'     => 'London Eye',
            'location' => new Point(51.5032973, -0.1195537),
        ]);
    }
}
