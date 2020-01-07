<!DOCTYPE html>
<html lang ="ja">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>
{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="text-center">
@if(Auth::check())
<a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カートの中身を見る</a></br>
<a href="{{ route('logout') }}">ログアウト</a>
@else
<a href="{{ route('home') }}">ログイン画面</a>
@endif
<table class="table">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href ="{{ route('item.detail', ['id' => $item->id]) }}">{{ $item->item_name }}</a></td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
@if ($item->stock > 0)
<td>在庫有り</td>
@else
<td>在庫なし</td>
@endif
</tr>
@endforeach
</table>
{{ $items->links() }}
<div>
</body>
</html>

