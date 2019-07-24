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
<div class="container">
<style>
table{
	border-collapse:collapse;
	margin:0 auto;
}

td,th{
	border-top:1px solid #666;
	padding:10px;
}
</style>
<body>
<!-- フラッシュメッセージ -->
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<table>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>追加</th>
<tr>
<td>{{ $item->item_name }}</a></td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
<!-- ログイン確認 -->
@if (Auth::check())
<!-- 在庫確認 -->
@if ($item->stock > 0)
<form class="form-horizontal" method="POST" action="{{ route('cart.add_item') }}">
{{ csrf_field() }}
<input type="hidden" name="hidden_item_id" value="{{ $item->id }}">
<td><input type="submit" value="カートに追加"></td>
</form>
@else
<td>在庫なし</td>
@endif
@else
<td>ログインしてください</td>
@endif
</tr>
</table>
</body>
</html>
