<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('confirm_token',$token)->first();
        if (!$user) {
            return response()->json(['message' => 'Token not found'], 404);
        }

        $user->verified = 1;
        $user->save();

        // メールアドレスの有効化後の遷移先
        return redirect('http://localhost:3000/users/thanks');
    }
}
