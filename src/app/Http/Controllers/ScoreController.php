<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Http\Requests\ScoreRequest;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    // レビュー一覧を取得する
    public function index()
    {
        // ログインユーザーIDを取得
        $user_id = Auth::id();

        if ($user_id) {
            // ログインユーザーの場合の処理
            $reviews = Score::with('shop')->with('user')->get();

        } else {
            // 未ログイン場合全てのレビューを取得する
            $reviews = Score::all();
        }

        if ($reviews->isEmpty()) {
            return response()->json(['message' => 'レビューが見つかりませんでした']);
        }

        return response()->json($reviews, 200);
    }

    // レビューを投稿する
    public function store(ScoreRequest $request)
    {
        try {
            // ログインユーザーIDを取得
            $user_id = Auth::id();

            // 選択された店舗IDを取得
            $shop_id = $request->input('shop_id');

            // レビューが投稿されているかを確認
            $doneReview = Score::where('user_id', $user_id)
                ->where('shop_id', $shop_id)
                ->first();

            // 投稿済の場合は、レスポンスを返す
            if ($doneReview) {

                return response()->json(['message' => 'この店舗はすでにレビューが投稿されています']);
            }

            // フォームから送信されたデータを取得
            $data = $request->all();

            // ログインユーザーIDと店舗IDを追加
            $data['user_id'] = $user_id;
            $data['shop_id'] = $shop_id;

            // データベースに保存
            $review = Score::create($data);

            return response()->json($review, 201);

        } catch (Exception $e) {

            return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }

    // お店ごとのレビューを取得する
    public function show($shop_id)
    {
        $reviews = Score::where('shop_id', $shop_id)->get();

        if (!$reviews) {
            return response()->json(['message' => 'レビューが見つかりませんでした']);
        }

        return response()->json($reviews, 200);
    }

    // レビューを削除する
    public function destroy($id)
    {
        $review = Score::find($id);

        if (!$review) {
            return response()->json(['message' => 'レビューが見つかりません'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'レビューが削除されました'], 200);
    }
}
