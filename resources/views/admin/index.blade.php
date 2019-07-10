<!DOCTYPE html>
<html lang ="ja">
<html>
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
@if(Auth::guard('admin')->check())
<a href="{{ route('item.add') }}">商品追加</a><br>
<a href="{{ route('item_admin.logout') }}">ログアウト</a>
@endif
<table>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
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
</body>
</html>
