<h1>確認画面</h1>
<form method="POST" action="{{ route('item.regist',['id'=>$item_id]) }}">
{{ csrf_field() }}
<h3>商品名</h3>
<p>{{ $item_name }}</p>
<h3>商品説名</h3>
<p>{{ $item_description }}</p>
<h3>商品在庫</h3>
<p>{{ $item_stock }}</p>
<input type="submit" value="登録">
