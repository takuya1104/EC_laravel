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
<!-- フラッシュメッセージ -->
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<a href="{{ route('item.index') }}">ホームへ戻る</a>
<!-- カートの中身確認 -->
@if (!$exist)
<p><?php echo "カートが空です"; ?></p>
@elseif ($exist)
<table>
<th>商品名</th>
<th>価格</th>
<th>数量</th>
<th>削除</th>
@foreach ($items_in_carts as $item)
<tr>
<td>&nbsp;{{ $item->item_name }}</td>
<td>&nbsp;{{ $item->price }}</td>
<td>&nbsp;{{ $item->item_amount }}</td>
<!-- 在庫確認 -->
@if ($item->stock != 0)
<form class="form-horizontal" method="POST" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
{{ method_field('delete') }}
<input type="hidden" name="cart_id" value="{{ $item->id }}">
<td><input type="submit" value="削除"></td>
</form>
@else
<td>&nbsp;在庫がありません</td>
@endif
</tr>
@endforeach
</table>
@endif
</body>
</html>


