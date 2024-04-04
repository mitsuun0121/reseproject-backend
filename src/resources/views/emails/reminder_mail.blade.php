    {{ $reservation->user->name }} 様<br><br>
    本日のご予約のご案内です。<br><br>

    予約詳細:<br>
    日付: {{ \Illuminate\Support\Carbon::parse($reservation->date)->format('Y年m月d日') }}<br>
    時間: {{ \Illuminate\Support\Carbon::parse($reservation->time)->format('H時') }}<br>
    人数: {{ $reservation->count }}名様<br><br>

    ご来店心よりお待ちしております。<br><br>

    Rservation QRCode<br>
     <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('$qrCodeImage')) !!}"><br><br>

    {{ $reservation->shop->name }}