<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // 予約一覧を取得する
    public function index()
    {
        if (Auth::check()) {
            // ログインユーザー
            $user_id = Auth::id();

            $reservations = Reservation::with('shop')->where('user_id', $user_id)->get();
            
        } else {
            // 店舗代表者
            $reservations = Reservation::with('shop')->with('user')->get();
        }
        return response()->json($reservations, 200);
    }

    // 予約を作成する
    public function store(ReservationRequest $request)
    {
        // ログインユーザーIDを取得
        $user_id = Auth::id();

        // 選択された店舗IDを取得
        $shop_id = $request->input('shop_id');

        // フォームから送信されたデータを取得
        $data = $request->all();

        // ログインユーザーIDと店舗IDを追加
        $data['user_id'] = $user_id;
        $data['shop_id'] = $shop_id;

        // データベースに保存
        $reservation = Reservation::create($data);

        return response()->json($reservation, 201);
    }

    // 予約を変更する
    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!$reservation) {
            return response()->json(['message' => '予約が見つかりません'], 404);
        }

        $reservation->update($request->all());

        return response()->json($reservation, 200);
    }

    // 予約を削除する
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (!$reservation) {
            return response()->json(['message' => '予約が見つかりません'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => '予約が削除されました'], 200);
    }
}
