<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Http\Requests\OwnerRegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OwnerAuthController extends Controller
{
    public function register(OwnerRegisterRequest $request)
    {
        // 店舗代表者を作成
        $shopId = intval($request->shop_id);
        $owner = new Owner([
            'shop_id' => $shopId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $owner->save();

        return response()->json(['message' => 'Successfully']);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('owner')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $owner = auth('owner')->user();
        $accessToken = Str::random(60);
        $owner->access_token = $accessToken;
        $owner->save();
        
        return $this->respondWithToken($token, $owner);
    }

    public function logout()
    {
        $owner = auth('owner')->user();

        if ($owner) {
            // アクセストークンを削除
            $owner->access_token = null;
            $owner->save();
        }

        auth('owner')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = auth('owner')->refresh();
        $owner = auth('owner')->user();

        return $this->respondWithToken($token, $owner);
    }

    public function me()
    {
        return response()->json(auth('owner')->user());
    }

    protected function respondWithToken($token, $owner)
    {
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('owner')->factory()->getTTL() * 60,
        'owner' => $owner,
        ]);
    }
}
