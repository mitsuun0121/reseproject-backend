<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // お気に入り一覧を取得する
    public function index()
    {
        // ログインユーザーIDを取得
        $user_id = Auth::id();

        $favorites = Favorite::with('shop')->where('user_id', $user_id)->get();

        if (!$favorites) {
            return response()->json(['message' => 'お気に入りが見つかりませんでした']);
        }

        return response()->json($favorites, 200);
    }

    // お気に入りに登録する
    public function store(Request $request)
    {
        try {
            // ログインユーザーIDを取得
            $user_id = Auth::id();

            // 選択された店舗IDを取得
            $shop_id = $request->input('shop_id');

            // お気に入りに登録されているかを確認
            $doneFavorite = Favorite::where('user_id', $user_id)
                ->where('shop_id', $shop_id)
                ->first();

            // お気に入りに登録されている場合
            if ($doneFavorite) {

                return response()->json(['message' => 'この店舗はすでにお気に入りに登録されています']);
            }

            // フォームから送信されたデータを取得
            $data = $request->all();

            // ログインユーザーIDと店舗IDを追加
            $data['user_id'] = $user_id;
            $data['shop_id'] = $shop_id;

            // データベースに保存
            $favorite = Favorite::create($data);

            return response()->json($favorite, 201);

        } catch (\Exception $e) {

            return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }

    public function show($shop_id)
    {
        // ログインユーザーIDを取得
        $user_id = Auth::id();

        $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

        if (!$favorite) {
            return response()->json(['message' => 'お気に入りが見つかりませんでした']);
        }
        // ログインユーザーIDとお気に入り登録ユーザーIDが一致しない場合は、データを返さない
        if ($favorite->user_id !== $user_id) {
            return response()->json(['message' => 'お気に入りが見つかりませんでした']);
        }

        return response()->json($favorite, 200);
    }

    // お気に入りを削除する
    public function destroy($id)
    {
        $favorites = Favorite::find($id);

        if (!$favorites) {
            return response()->json(['message' => 'お気に入りが見つかりません'], 404);
        }

        $favorites->delete();

        return response()->json(['message' => 'お気に入りが削除されました'], 200);
    }
}
