<DOCTYPE html>
<html lang ="ja">
<html>
<head>
<title>Confirm Address</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
 body { color: black; }
</style>
</head>

<body style="background-color:white;">
<div class="container">
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbarEexample8">
<span class="sr-only"></span>
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
<li><a href="{{ route('settlement.index') }}">決済画面</a></li>
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

<div class="center-block">
@if (session('flash_message'))
<div class="flash_message bg-info text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
@if ($registered_address->isEmpty())
<p class="text-center"><?php echo "住所が登録されていません"; ?></p>
@else
<table class="table">
<th>利用者名</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>都道府県以下の住所</th>
<th>電話番号</th>
<th>削除</th>
<th>編集</th>
@foreach ($registered_address as $address)
<tr>
<td>&nbsp;{{ $address->customer_name }}</td>
<td>&nbsp;{{ $address->postal_code}}</td>
<td>&nbsp;{{ $address->prefecture->pref_name}}</td>
<td>&nbsp;{{ $address->city}}</td>
<td>&nbsp;{{ $address->phone_number }}</td>
<form class="form-horizontal" method="POST" action="{{ route('address.del_address') }}">
{{ csrf_field() }}
{{ method_field('delete') }}
<input type="hidden" value="{{ $address->id }}" name="del_hidden_id">
<td><input class="btn btn-info" type="submit" value="削除"></td>
</form>
<td><a class="btn btn-primary" href="{{ route('address.edit_address', ['id' => $address->id]) }}">編集</a>
</tr>
@endforeach
</table>
@endif
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</html>
