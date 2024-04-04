<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'name' => '管理者',
        'email' => 'example@gmail.com',
        'password' => Hash::make('1234abcd'),
        ];
        Admin::create($param);
    }
}
