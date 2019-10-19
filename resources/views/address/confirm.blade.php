<DOCTYPE html>
<html lang ="ja">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<a href="{{ route('item.index') }}">ホームへ戻る</a>
<a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カートへ戻る</a>
<a href="{{ route('address.index', ['id' => Auth::id()]) }}">住所追加</a>
@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
@if ($registered_address->isEmpty())
<p><?php echo "住所が登録されていません"; ?></p>
@else
<table>
<th>利用者名</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>都道府県以下の住所</th>
<th>電話番号</th>
<th>削除</th>
<th>編集</th>
<th>選択</th>
@foreach ($registered_address as $address)
<tr>
<td>&nbsp;{{ $address->customer_name }}</td>
<td>&nbsp;{{ $address->postal_code}}</td>
<td>&nbsp;{{ $address->prefecture}}</td>
<td>&nbsp;{{ $address->city}}</td>
<td>&nbsp;{{ $address->phone_number }}</td>
<form class="form-horizontal" method="POST" action="{{ route('address.del_address', ['id' => $address->id]) }}">
{{ csrf_field() }}
{{ method_field('delete') }}
<td><input type="submit" value="削除"></td>
</form>
<form class="form-horizontal" method="GET" action="{{ route('address.edit_address', ['id' => $address->id]) }}">
{{ csrf_field() }}
<td><input type="submit" value="編集"></td>
</form>
<td><input type="checkbox" name="check_address[]" value="{{ $address->id }}"></td>
</tr>
@endforeach
</table>
@endif
</body>
</html>

