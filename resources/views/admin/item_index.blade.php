<!DOCTYPE html>
<html lang ="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if(Auth::guard('admin')->check())
<a href="{{ route('admin_item.add') }}">商品追加</a><br>
<a href="{{ route('admin_item.logout') }}">ログアウト</a>
@endif
<div class="container">
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
<th>在庫</th>
@foreach ($items as $item)
<tr>
<td><a href ="{{ route('admin_item.detail', ['id' => $item->id]) }}">{{ $item->item_name }}</a></td>
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
<p class="pagenate">
{{ $items->links() }}
</p>
</div>
</body>
 @yield('content')
</html>
