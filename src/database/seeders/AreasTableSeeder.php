<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area1 = Area::create(['name' => '東京都']);
        $area2 = Area::create(['name' => '大阪府']);
        $area3 = Area::create(['name' => '福岡県']);
    }
}
