<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        // 管理者のデータを取得
        $data = Admin::all();

        return response()->json($data, 200);
    }
}
