<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    public function run()
    {
        //
        Governorate::create([
            'name' => 'Alexandria'
        ]);
        Governorate::create([
            'name' => 'Aswan'
        ]);
        Governorate::create([
            'name' => 'Asyut'
        ]);
        Governorate::create([
            'name' => 'Beheira'
        ]);
        Governorate::create([
            'name' => 'Beni Suef'
        ]);
        Governorate::create([
            'name' => 'Cairo'
        ]);
        Governorate::create([
            'name' => 'Dakahlia'
        ]);
        Governorate::create([
            'name' => 'Damietta'
        ]);
        Governorate::create([
            'name' => 'Faiyum'
        ]);
        Governorate::create([
            'name' => 'Gharbia'
        ]);
        Governorate::create([
            'name' => 'Giza'
        ]);
        Governorate::create([
            'name' => 'Ismailia'
        ]);
        Governorate::create([
            'name' => 'Kafr El Sheikh'
        ]);
        Governorate::create([
            'name' => 'Luxor'
        ]);
        Governorate::create([
            'name' => 'Matruh'
        ]);
        Governorate::create([
            'name' => 'Minya'
        ]);
        Governorate::create([
            'name' => 'Monufia'
        ]);
        Governorate::create([
            'name' => 'New Valley'
        ]);
        Governorate::create([
            'name' => 'North Sinai'
        ]);
        Governorate::create([
            'name' => 'Port Said'
        ]);
        Governorate::create([
            'name' => 'Qalyubia'
        ]);
        Governorate::create([
            'name' => 'Qena'
        ]);
        Governorate::create([
            'name' => 'Red Sea'
        ]);
        Governorate::create([
            'name' => 'Sharqia'
        ]);
        Governorate::create([
            'name' => 'Sohag'
        ]);
        Governorate::create([
            'name' => 'South Sinai'
        ]);
        Governorate::create([
            'name' => 'Suez'
        ]);
    }
}
