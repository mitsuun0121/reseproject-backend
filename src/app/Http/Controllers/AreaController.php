<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        // エリアデータを取得
        $areaData = Area::all();

        return response()->json($areaData, 200);
    }

    public function show($id)
    {
        // 特定のIDに対応するエリアを取得
        $area = Area::findOrFail($id);

        return response()->json($area, 200);
    }
}
