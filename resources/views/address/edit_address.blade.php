<head>
<title>Edit Address</title>
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
<li><a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カート</a></li>
<li><a href="{{ route('address.index', ['id' => Auth::id()]) }}">住所追加</a></li>
<li><a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所確認画面</a></li>
<li><a href="{{ route('settlement.index') }}">決済画面へ</a></li>
<li><a href="{{ route('settlement.confirm', ['id' => Auth::id()]) }}">決済履歴</a></li>
<li><a href="{{ route('logout') }}" class="ml-4">ログアウト</a></li>
@endif
</ul>
</div>
</div>
</nav>
<br>
<br>
<br>

@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<div class="row">
<form class="form-horizontal" method="POST" action="{{ route('address.add') }}">
{{ csrf_field() }}
<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">利用者名</label>
<div class="col-sm-5">
<input id="customer_name" class="form-control" name="customer_name" value="{{ $customer_name }}">
{{ $errors->first('customer_name') }}
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputSelect">電話番号</label>
<div class="col-sm-5">
<input id="address" class="form-control" name="phone" value="{{ $phone_number }}">
{{ $errors->first('phone') }}
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputName">郵便番号</label>
<div class="col-sm-5 form-inline">
<input id="postal1" class="form-control"  name="postal_code1" value="{{ $postal_code[0] }}" maxlength="3">
-<input id="postal2" class="form-control"  name="postal_code2" value="{{ $postal_code[1] }}" maxlength="4"><br>
{{ $errors->first('postal_code1') }}
{{ $errors->first('postal_code2') }}
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputSelect">都道府県</label>
<div class="col-sm-2">
<select name="pref" class="form-control select select-default">
@foreach ($prefectures as $pref)
<option value="{{ $pref->id  }} . {{ $pref->pref_name }}" <?php if ( $pref->id == $prefecture_id ) { echo 'selected="true"'; } ?>>{{ $pref->pref_name }}</option>
@endforeach
</select>
{{ $errors->first('pref') }}
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-2 control-label" for="InputSelect">それ以下の住所</label>
<div class="col-sm-10">
<input id="address" class="form-control" name="address" value="{{ $city }}">
{{ $errors->first('address') }}
</div>
</div>
<br>

<div class="text-center">
<input type="hidden" name="hidden_id" value="{{ $id }}">
<button type="submit" class="btn btn-primary">
追加
</button>
</div>
</form>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

