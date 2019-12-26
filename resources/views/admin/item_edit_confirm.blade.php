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
<a href="{{ route ('admin_item.edit', ['id' => $id]) }}">編集画面に戻る</a>
<form method="POST" action="{{ route('admin_item.regist',['id'=>$id]) }}">
{{ csrf_field() }}
<h3>商品名</h3>
<p>{{ $item_name }}</p>
<h3>商品説名</h3>
<p>{{ $item_description }}</p>
<h3>商品在庫</h3>
<p>{{ $item_stock }}</p>
<h3>画像登録</h3>
@if (!is_null($item_file_name))
<td><img src="{{ asset('storage') . '/' . $item_file_name }}" style="width:140px"></td>
@else
<td>画像登録なし</td>
@endif
<br>
<input type="submit" value="登録">
