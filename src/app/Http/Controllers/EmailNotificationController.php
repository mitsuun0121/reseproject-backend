<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;

class EmailNotificationController extends Controller
{
    public function noticeMail(Request $request)
    {
        // メール送信処理
        $data = $request->all();

         // カンマで区切られたメールアドレスを配列に入れる
        $emails = explode(',', $data['emailList']);
        $message = $data['message'];
        $shopName = $data['shopName'];

        // メールを送信する
        foreach ($emails as $email) {
            Mail::to(trim($email))->send(new NotificationEmail($message, $shopName));
        }

        return response()->json(['message' => 'メールが送信されました'], 200);
    }
}
