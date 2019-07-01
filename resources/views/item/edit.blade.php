<form class="form-horizontal" method="POST" action="{{ route('item.confirm', ['id'=>$data_item->id]) }}">
{{ csrf_field() }}
{{ method_field('patch') }}
<p>商品名</p>
<input id="item_name"name="item_name" value="{{ $data_item->item_name }}" required autofocus><br>
 {{ $errors->first('item_name') }}
<p>商品説明</p>
<input id="item_description"name="item_description" value="{{ $data_item->description }}"  required autofocus><br>
 {{ $errors->first('item_description') }}
<p>商品在庫</p>
<input id="item_stock"name="item_stock" value="{{ $data_item->stock }}"  required autofocus><br>
 {{ $errors->first('item_stock') }}
<br>
<button type="submit" class="btn btn-primary">
変更
</button>

