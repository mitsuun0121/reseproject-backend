<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        // 新規ユーザーを作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_token' => Str::random(40)
        ]);

        SendVerificationEmail::dispatch($user);
      
        // メールアドレスの確認メッセージ
        return response()->json(['message' => '新規会員登録を完了するためにメールを確認してください'], 200);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('user')->user();
        $accessToken = Str::random(60);
        $user->access_token = $accessToken;
        $user->save();
        
        return $this->respondWithToken($token, $user);
    }

    public function logout()
    {
        $user = auth('user')->user();

        if ($user) {
            $user->access_token = null;
            $user->save();
        }

        auth('user')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = auth('user')->refresh();
        $user = auth('user')->user();

        return $this->respondWithToken($token, $user);
    }

    public function me()
    {
        return response()->json(auth('user')->user());
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('user')->factory()->getTTL() * 60,
        'user' => $user,
        ]);
    }
}
