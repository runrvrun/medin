<!doctype html>



<html>

<head>

    <title>Undangan: {{ $event->event }}</title>

</head>



<body>

<h2>Hello {{$fullname}}!</h2>
<p>Anda menerima undangan untuk event berikut:</p>
<br/>
<p>Event: {{ $event->event }}</p>
<p>Jadwal: {{ \Carbon\Carbon::parse($event->datetime)->format('l, j M Y H:i') }}</p>
<p>Lokasi: {{ $event->address }}</p>
<p>Wilayah: {{ $event->city }}</p>
</br>
</br>
<p>Untuk konfirmasi kedatangan silakan klik link berikut:</p>
<p><a href="{{ url('admin/invitation') }}">Konfirmasi kehadiran</a>.</p>
<br/>
<br/>
<p>Terima kasih</p>
<h4>ADMIN MEDIN</h4>
</body>

</html>

