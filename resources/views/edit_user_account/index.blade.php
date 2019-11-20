<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<form class="form-horizontal" method="POST" action="{{ route('edit_user_account.receive_input') }}">
{{ csrf_field() }}
<p>名前</p>
<input id="" name="user_name" value="{{ old('user_name') }}"><br>
 {{ $errors->first('user_name') }}
<p>新しいメールアドレス</p>
<input id="" name="user_email" value="{{ old('user_email') }}"><br>
 {{ $errors->first('user_email') }}
<p>パスワード</p>
<input id="" name="new_password" value="{{ old('new_password') }}"><br>
 {{ $errors->first('new_password') }}
<p>パスワード確認用</p>
<input id="" name="confirm_password" value="{{ old('confirm_password') }}"><br>
 {{ $errors->first('confirm_password') }}
<p>現在のパスワード</p>
<input id="" name="using_password" value="{{ old('using_password') }}"><br>
 {{ $errors->first('using_password') }}
<br>
<button type="submit" class="btn btn-primary">
変更
</button>
