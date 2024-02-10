<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penolakan Notulensi Rapat</title>
</head>

<body>

    <div style="display: flex; align-items: center; justify-content: center;">
        <img src="{{ $message->embed(public_path('img/nolan-ungu.png')) }}" style="max-width: 200px; height: auto;">
    </div>

    <p>Yth. {{ $noteTakerName }},</p>
    <p>Pertemuan dengan judul <strong>{{ $meeting_name }}</strong> telah ditolak oleh
        <strong>{{ $writerName }}</strong></p>
    <p>Alasan Penolakan: </p> <br>
    <strong> {{ $rejectionMessage }}</strong>
    <p>Silakan kunjungi tautan di bawah ini untuk melihat detail pertemuan:</p>
    <p>Link Pertemuan: <a href="{{ $linkEdit }}">{{ $linkEdit }}</a></p>

</body>

</html>
