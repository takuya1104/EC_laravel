<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<h1>確認画面</h1>
<form method="POST" action="{{ route('admin_item.regist',['id'=>$item_id]) }}">
{{ csrf_field() }}
<h3>商品名</h3>
<p>{{ $item_name }}</p>
<h3>商品説名</h3>
<p>{{ $item_description }}</p>
<h3>商品在庫</h3>
<p>{{ $item_stock }}</p>
<input type="submit" value="登録">
