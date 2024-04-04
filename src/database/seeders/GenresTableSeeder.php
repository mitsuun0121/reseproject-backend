<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre1 = Genre::create(['name' => '寿司']);
        $genre2 = Genre::create(['name' => '焼肉']);
        $genre3 = Genre::create(['name' => '居酒屋']);
        $genre4 = Genre::create(['name' => 'イタリアン']);
        $genre5 = Genre::create(['name' => 'ラーメン']);
    }
}
