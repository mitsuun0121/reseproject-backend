<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Http\Requests\ScoreRequest;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    // 口コミ一覧を取得する
    public function index()
    {
        // ログインユーザーIDを取得
        $user_id = Auth::id();

        if ($user_id) {
            // ログインユーザーの場合の処理
            $reviews = Score::with('shop')->with('user')->get();

        } else {
            // 未ログインの場合
            $reviews = Score::with('shop')->with('user')->get();
        }

        if ($reviews->isEmpty()) {
            return response()->json(['message' => '口コミが見つかりませんでした']);
        }

        return response()->json($reviews, 200);
    }

    // 口コミを投稿する
    public function store(ScoreRequest $request)
    {
        try {
            // ログインユーザーIDを取得
            $user_id = Auth::id();

            // 選択された店舗IDを取得
            $shop_id = $request->input('shop_id');

            // 口コミが投稿されているかを確認
            $doneReview = Score::where('user_id', $user_id)
                ->where('shop_id', $shop_id)
                ->first();

            // 投稿済の場合は、レスポンスを返す
            if ($doneReview) {
                return response()->json(['message' => 'この店舗はすでに口コミが投稿されています']);
            }

            // 画像のアップロード処理
            $path = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $dir = 'public/uploads';

                // 画像を保存、パスを取得
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($dir), $fileName);
                $path = $dir . '/' . $fileName;
            }

            // フォームから送信されたデータを取得
            $data = $request->all();
            $data['user_id'] = $user_id;
            $data['shop_id'] = $shop_id;
            $data['image'] = $path;

            // データベースに保存
            $review = Score::create($data);

            return response()->json($review, 201);
            
        } catch (\Exception $e) {

            return response()->json(['message' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }

    // お店ごとの口コミを取得する
    public function show($shop_id)
    {
        $reviews = Score::where('shop_id', $shop_id)->get();

        if ($reviews->isEmpty()) {
            return response()->json(['message' => '口コミが見つかりませんでした']);
        }

        return response()->json($reviews, 200);
    }

    // 口コミを編集する
    public function update(Request $request, $id)
    {
        try {
            // 更新する口コミを取得
            $review = Score::findOrFail($id);

            // 口コミの評価、タイトル、コメントを更新
            $review->review = $request->input('review');
            $review->title = $request->input('title');
            $review->comment = $request->input('comment');

            // 口コミを保存
            $review->save();

            return response()->json($review, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => '口コミの更新に失敗しました: ' . $e->getMessage()], 500);
        }
    }

    // 口コミを削除する
    public function destroy($id)
    {
        $review = Score::find($id);

        if (!$review) {
            return response()->json(['message' => '口コミが見つかりません'], 404);
        }

        $review->delete();

        return response()->json(['message' => '口コミが削除されました'], 200);
    }
}
