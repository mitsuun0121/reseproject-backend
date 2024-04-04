<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        // Stripe APIキーを設定
        Stripe::setApiKey(config('services.stripe.secret'));
        
        try {
            // 支払いセッションを作成
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => 'お支払い金額',
                        ],
                        'unit_amount' => 1000,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://localhost:3000/users/payment', // 支払い成功時のリダイレクトURL
                'cancel_url' => 'http://localhost:3000/users/done', // 支払いキャンセル時のリダイレクトURL
            ]);

            \Log::info($session);

            return response()->json(['sessionId' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
