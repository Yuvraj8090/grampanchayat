<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['name' => 'Uttarkashi', 'district_code' => '113-05001'],
            ['name' => 'Chamoli', 'district_code' => '113-05002'],
            ['name' => 'Rudraprayag', 'district_code' => '113-05003'],
            ['name' => 'Tehri Garhwal', 'district_code' => '113-05004'],
            ['name' => 'Dehradun', 'district_code' => '113-05005'],
            ['name' => 'Garhwal', 'district_code' => '113-05006'],
            ['name' => 'Pithoragarh', 'district_code' => '113-05007'],
            ['name' => 'Bageshwar', 'district_code' => '113-05008'],
            ['name' => 'Almora', 'district_code' => '113-05009'],
            ['name' => 'Champawat', 'district_code' => '113-05010'],
            ['name' => 'Nainital', 'district_code' => '113-05011'],
            ['name' => 'Udham Singh Nagar', 'district_code' => '113-05012'],
            ['name' => 'Hardwar', 'district_code' => '113-05013'],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['district_code' => $district['district_code']],
                [
                    'name' => $district['name'],
                    'is_active' => true
                ]
            );
        }
    }
}