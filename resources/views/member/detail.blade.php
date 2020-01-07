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
<table class="table">
<th>ユーザー名</th>
<th>メールアドレス</th>
<th>お届け先住所</th>
<tr>
<td>{{ $user_data->name  }}</td>
<td>{{ $user_data->email }}</td>
@if($user_data->address->isEmpty())
<td>{{ '住所登録がありません' }}</td>
@else
@foreach ($user_data->address as $address)
<td>{{ $address->postal_code }}</td>
<td>{{ $address->prefecture->pref_name }}</td>
<td>{{ $address->city }}</td>
@endforeach
@endif
</tr>
</table>
</body>
</html>

