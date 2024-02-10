<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Notulensi Rapat</title>
</head>

<body>
    <div>

        <div style="display: flex; align-items: center; justify-content: center; text-align: center;">
            <img src="{{ $message->embed(public_path('img/nolan-ungu.png')) }}" style="max-width: 200px; height: auto;">
        </div>
        

        <p>Yth. Semua Peserta Rapat <strong>{{ $meetingName }}</strong>,</p>
        <p>Notulensi rapat {{ $meetingName }} telah selesai dibuatkan. Silakan kunjungi tautan di bawah ini untuk
            melihat hasil rapat yang berlangsung dan diminta untuk menyetujui atau merevisinya.</p>
        <p>Link Approval: <a href="{{ $LinkApproval }}">{{ $LinkApproval }}</a></p>
    </div>
</body>

</html>
