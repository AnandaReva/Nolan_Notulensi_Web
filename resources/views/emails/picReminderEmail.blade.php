<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Follow Up Action</title>
</head>

<body>
    <div style="display: flex; align-items: center; justify-content: center; text-align: center;">
        <img src="{{ $message->embed(public_path('images/nolan-ungu.png')) }}" style="max-width: 200px; height: auto;">
    </div>

    <p><strong>To:</strong> {{ $picName }}</p>
    <p><strong>Subject:</strong> Reminder Follow Up Action Meeting {{ $meeting_name }}</p>

    <p>
        <strong>Body:</strong><br>
        Yth. {{ $picName }},<br><br>

        Diingatkan kembali kepada Bapak/Ibu {{ $picName }} untuk segera menyelesaikan follow up action:
        <strong>{{ $action }}</strong> dari hasil rapat <strong>{{ $meeting_name }}</strong>
        pada tanggal {{ $meeting_date }}. Tenggat waktu yang diberikan sampai pada tanggal
        <strong>{{ $due_date }}</strong>,
        dimohon untuk menyelesaikannya sebelum tenggat waktu habis. Terima Kasih.


    </p>
    <p>Link Detail Rapat: <a href="{{ $linkView }}">{{ $linkView }}</a></p>

</body>

</html>
