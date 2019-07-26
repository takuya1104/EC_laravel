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
<body>
@if(Auth::check())
<a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カートの中身を見る</a></br>
<a href="{{ route('logout') }}">ログアウト</a>
@else
<a href="{{ route('home') }}">ログイン画面</a>
@endif
<table>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
@foreach ($items as $item)
<tr>
<td><a href ="{{ route('item.detail', ['id' => encrypt($item->id)]) }}">{{ $item->item_name }}</a></td>
<td>&nbsp;{{ $item->description }}</td>
<td>&nbsp;{{ $item->price }}</td>
@if ($item->stock > 0)
<td>&nbsp;在庫有り</td>
@else
<td>&nbsp;在庫なし</td>
@endif
</tr>
@endforeach
</table>
{{ $items->links() }}
</body>
</html>

