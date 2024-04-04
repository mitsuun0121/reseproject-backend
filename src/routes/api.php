<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\EmailNotificationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// お店のデータを取得
Route::apiResource('shop', ShopController::class);

// エリアデータを取得
Route::apiResource('area', AreaController::class);

// ジャンルデータを取得
Route::apiResource('genre', GenreController::class);

// お店の予約に関するルート
Route::apiResource('reservation', ReservationController::class);

// お気に入りに関するルート
Route::apiResource('favorite', FavoriteController::class);

// レビューに関するルート
Route::apiResource('review', ScoreController::class);

// お知らせメールを送信
Route::post('notice-mail', [EmailNotificationController::class, 'noticeMail']);

// Stripe決済に関するルート
Route::post('create-checkout-session', [StripeController::class, 'createCheckoutSession']);

// ユーザーのメール認証のルート
Route::get('/auth/verifyemail/{token}', [EmailVerificationController::class, 'verify']);

// ユーザーを取得
Route::apiResource('user', UserController::class);

// ユーザー用の認証ルート
Route::group(['prefix' => 'auth/user'], function ($router) {
  Route::post('register', [UserAuthController::class, 'register']);
  Route::post('login', [UserAuthController::class, 'login']);
  Route::post('logout', [UserAuthController::class, 'logout']);
  Route::post('refresh', [UserAuthController::class, 'refresh']);
  Route::get('user', [UserAuthController::class, 'me']);
});

// 管理者を取得
Route::apiResource('admin', AdminController::class);

// 管理者用の認証ルート
Route::group(['prefix' => 'auth/admin'], function ($router) {
  Route::post('login', [AdminAuthController::class, 'login']);
  Route::post('logout', [AdminAuthController::class, 'logout']);
  Route::post('refresh', [AdminAuthController::class, 'refresh']);
  Route::get('user', [AdminAuthController::class, 'me']);
});

// 店舗代表者を取得
Route::apiResource('owner', OwnerController::class);

// 店舗代表者用の認証ルート
Route::group(['prefix' => 'auth/owner'], function ($router) {
  Route::post('register', [OwnerAuthController::class, 'register']);
  Route::post('login', [OwnerAuthController::class, 'login']);
  Route::post('logout', [OwnerAuthController::class, 'logout']);
  Route::post('refresh', [OwnerAuthController::class, 'refresh']);
  Route::get('user', [OwnerAuthController::class, 'me']);
});