<!DOCTYPE html>
<html lang ="ja">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<table>
<th>会員一覧</th>
@foreach ($users as $user)
<tr>
<td><a href="{{ route('member.detail', ['id' => $user->id])  }}">{{ $user->name  }}</a></td>
</tr>
@endforeach
</table>
</body>
</html>

