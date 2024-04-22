<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // ユーザーのデータを取得
        $data = User::all();
        
        return response()->json($data, 200);
    }
}
