<form class="form-horizontal" method="POST" action="{{ route('item.add_confirm') }}">
{{ csrf_field() }}
<p>商品名</p>
<input id="item_name" name="item_name"><br>
 {{ $errors->first('item_name') }}
<p>商品説明</p>
<input id="item_description" name="item_description"><br>
 {{ $errors->first('item_description') }}
<p>商品価格</p>
<input id="item_description" name="item_price"><br>
 {{ $errors->first('item_price') }}
<p>商品在庫</p>
<input id="item_stock" name="item_stock"><br>
 {{ $errors->first('item_stock') }}
<br>
<button type="submit" class="btn btn-primary">
変更
</button>


