<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<form class="form-horizontal" method="POST" action="{{ route('admin_item.confirm', ['id'=>$data_item->id]) }}">
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

