<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">
<title>Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<br>
<br>
<br>
<br>

<header>
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
</header>

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-10 col-md-offset-1">
@if ($items_in_carts->isNotEmpty())
<table class="table table-hover">
<thead>
<tr>
<th scope="col">商品</th>
<th>数量</th>
<th class="text-center">価格</th>
<th></th>
<th>削除</th>
</tr>
</thead>
<tbody>
@foreach ($items_in_carts as $item)
<tr>
<td class="col-sm-8 col-md-6">
<div class="media">
<a class="thumbnail pull-left" href="{{ route('item.detail', ['id' => $item->item->id]) }}"> <img class="media-object" src="{{ asset('storage') . '/' . $item->item->file_name }}" style="width: 72px; height: 72px;"> </a>
<div class="media-body">
<h4 class="media-heading"><a href="{{ route('item.detail', ['id' => $item->item->id]) }}">{{ $item->item->item_name }}</a></h4>
<p>{{ $item->item->description }}</p>
</div>
</div></td>
<td class="col-sm-1 col-md-1" style="text-align: center">
{{ $item->item_amount }}
</td>
<td class="col-sm-1 col-md-1 text-center"><strong>{{ $item->item->price }}</strong></td>
<td class="col-sm-1 col-md-1">
<td>
<form class="form-horizontal" method="POST" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
{{ method_field('delete') }}
<input type="hidden" name="cart_id" value="{{ $item->id }}">
<input type="submit" value="削除"></td>
</form>
</td>
</tr>
@endforeach
</tbody>
<tr>
<td>   </td>
<td>   </td>
<td>   </td>
</tr>
<tr>
<td>   </td>
<td>   </td>
<td>   </td>
<td>   </td>
<td>
<button type="button" class="btn btn-info" onclick="location.href='{{ route('settlement.index') }}'">
<span class="glyphicon glyphicon-play">決済画面へ</span>
</button></td>
</tr>
</table>
@else
<p class="text-center">{{ 'カート内に商品がありません' }}</p>
@endif
</div>
</div>
</div>
</body>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</html>
