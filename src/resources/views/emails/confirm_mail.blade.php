{{ $user->name }} 様<br><br>
この度は無料会員登録にお申し込みいただきありがとうございます。<br><br>

以下のリンクをクリックしていただきメールアドレスの認証を行ってください：<br><br>

<a href="{{ url('auth/verifyemail/' . $confirm_token) }}">{{ url('auth/verifyemail/' . $confirm_token) }}</a><br><br>

何かご不明点があれば、お気軽にお問い合わせください。<br><br>

ご登録をお待ちしております。<br><br>

Rese