<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Office Seeder
 */
class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Search for Dublin office, update if existing or create new
        Office::updateOrCreate(
            [
                'latitude' => '53.3340285',
                'longitude' => '-6.2535495',
            ],
            [
                'name' => 'Dublin',
                'latitude' => '53.3340285',
                'longitude' => '-6.2535495',
            ]
        );
    }
}
