<head>
<title>Edit User</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
 body { color: black; background-color: white;}
</style>
</head>
<body>

<div class="container">
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbarEexample8">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="{{ route('item.index') }}" style="color:white;">
HOME
</a>
</div>

<div class="collapse navbar-collapse" id="navbarEexample8">
<ul class="nav navbar-nav">
@if (Auth::check())
<li><a href="{{ route('logout') }}" class="ml-4">ログアウト</a></li>
<li><a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カート</a></li>
<li><a href="{{ route('edit_user_account', ['id'=>Auth::id()]) }}">ユーザー情報編集</a></li>
<li><a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所確認画面</a></li>
<li><a href="{{ route('settlement.confirm', ['id' => Auth::id()]) }}">決済履歴</a></li>
@endif
</ul>
</div>
</div>
</nav>
<br>
<br>
<br>
<div class="row">
@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<div class="form-group">
<form class="form-horizontal" method="POST" action="{{ route('edit_user_account.receive_input') }}">
{{ csrf_field() }}

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">名前</label>
<div class="col-sm-10">
<input class="form-control" name="user_name" value="{{ old('user_name') }}"><br>
{{ $errors->first('user_name') }}
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">登録済み若しくは新規に登録するメールアドレス</label>
<div class="col-sm-10">
<input type="email" class="form-control" name="user_email" value="{{ old('user_email') }}"><br>
{{ $errors->first('user_email') }}
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">新規パスワード</label>
<div class="col-sm-10">
<input  type="password" class="form-control" name="new_password" value="{{ old('new_password') }}"><br>
{{ $errors->first('new_password') }}
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">新規パスワード確認用</label>
<div class="col-sm-10">
<input type="password" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}"><br>
{{ $errors->first('confirm_password') }}
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">現在のパスワード</label>
<div class="col-sm-10">
<input  type="password" class="form-control" name="using_password" value="{{ old('using_password') }}"><br>
{{ $errors->first('using_password') }}
</div>
</div>

<div class="text-center">
<button type="submit" class="btn btn-primary">
変更
</button>
</div>
</div>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
