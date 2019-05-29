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
<table>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
<tr>
<td>{{ $item->item_name }}</a></td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
@if ($item->stock > 0)
<td>在庫有り</td>
@else
<td>在庫なし</td>
@endif
</tr>
</table>
</body>
</html>
