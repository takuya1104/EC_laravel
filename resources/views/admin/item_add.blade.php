<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-horizontal" method="POST" action="{{ route('admin_item.add_confirm') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<p>商品名</p>
<input id="item_name" name="item_name" value="{{ old('item_name') }}"><br>
{{ $errors->first('item_name') }}
<p>商品説明</p>
<textarea rows="10" cols="30" id="item_description" name="item_description" value="{{ old('item_description') }}">{{ old('item_description') }}</textarea><br>
{{ $errors->first('item_description') }}
<p>商品価格</p>
<input id="item_description" name="item_price" value="{{ old('item_price') }}"><br>
{{ $errors->first('item_price') }}
<p>商品在庫</p>
<input id="item_stock" name="item_stock" value="{{ old('item_stock') }}"><br>
{{ $errors->first('item_stock') }}
<p>商品画像</p>
<label>
<span class="btn btn-primary">
<input type="file" id="item_stock" name="item_file" value="{{ old('item_file') }}" ><br>
{{ $errors->first('item_file') }}
</span>
</label>
<br>
<button type="submit" class="btn btn-primary">
追加
</button>
<body>
