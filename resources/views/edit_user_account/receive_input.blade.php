<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<form class="form-horizontal" method="POST" action="{{ route('edit_user_account.receive_input') }}">
{{ csrf_field() }}
<p>商品名</p>
<input id="" name="user_name" value="{{ old('user_name') }}"><br>
 {{ $errors->first('user_name') }}
<p>商品説明</p>
<input id="" name="user_email" value="{{ old('user_email') }}"><br>
 {{ $errors->first('user_email') }}
<p>商品価格</p>
<input id="" name="user_password" value="{{ old('user_password') }}"><br>
 {{ $errors->first('user_password') }}
<p>商品在庫</p>
<input id="" name="confirm_password" value="{{ old('confirm_password') }}"><br>
 {{ $errors->first('confirm_password') }}
<br>
<button type="submit" class="btn btn-primary">
変更
</button>

