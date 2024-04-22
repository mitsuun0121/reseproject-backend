<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $admin = auth('admin')->user();
        $accessToken = Str::random(60);
        $admin->access_token = $accessToken;
        $admin->save();
        
        return $this->respondWithToken($token, $admin);
    }

    public function logout()
    {
        $admin = auth('admin')->user();

        if ($admin) {
            // アクセストークンを削除
            $admin->access_token = null;
            $admin->save();
        }

        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = auth('admin')->refresh();
        $admin = auth('admin')->user();

        return $this->respondWithToken($token, $admin);
    }

    public function me()
    {
        return response()->json(auth('admin')->user());
    }

    protected function respondWithToken($token, $admin)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('admin')->factory()->getTTL() * 60,
        'admin' => $admin,
        ]);
    }
}
