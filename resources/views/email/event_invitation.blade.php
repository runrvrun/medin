<!doctype html>



<html>

<head>

    <title>Undangan: {{ $event->event }}</title>

</head>



<body>

<h2>Hi {{$fullname}}</h2>
<p>Anda diundang untuk menghadiri event berikut:.</p>
<br/><br/>
<p>{{ $event->event }}</p>
<p>{{ \Carbon\Carbon::parse($event->datetime)->format('l, j M Y H:i') }}</p>
<p>{{ $event->address }}</p>
</br>
</br>
<p>Konfirmasi kehadiran Anda <a href="{{ url('admin/invitation') }}">disini</a>.</p>
<h4>MedIn</h4>
</body>

</html>

