<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 検索クエリパラメータを取得
        $searchWord = $request->query('search');

        // スペースを入れて複数ワード検索
        $keywords = explode('　', $searchWord);

        // Eloquentクエリを初期化
        $query = Shop::query();

        // 検索条件を追加
        foreach ($keywords as $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                    ->orWhereHas('area', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%");
                    })
                    ->orWhereHas('genre', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%");
                    });
            });
        }
        // 検索結果を取得
        $shopData = $query->get();

        return response()->json($shopData, 200);
    }

    public function show($id)
    {
        // 指定されたIDを持つお店の情報を取得
        $shopData = Shop::findOrFail($id);
        
        return response()->json($shopData, 200);
    }

    // 店舗データを変更する
    public function update(Request $request, $id)
    {
        $shopData = Shop::findOrFail($id);

        if (!$shopData) {
            return response()->json(['message' => '店舗が見つかりません'], 404);
        }

        $shopData->update($request->all());

        return response()->json($shopData, 200);
    }
}
