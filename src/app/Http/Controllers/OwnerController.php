<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function index()
    {
        // 店舗代表者のデータを取得
        $owner = Owner::with('shop')->with('shop.area')->with('shop.genre')->get();

        if (!$owner) {
            return response()->json(['message' => '店舗代表者が見つかりませんでした']);
        }

        return response()->json($owner, 200);
    }

    public function show($shop_id)
    {
        // 店舗の予約データを取得
        $owner = Owner::with('reservation')->with('shop')->where('shop_id', $shop_id)->get();

        if (!$owner) {
            return response()->json(['message' => '店舗の予約データが見つかりませんでした']);
        }
        
        return response()->json($owner, 200);
    }
}
