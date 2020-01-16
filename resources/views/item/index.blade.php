<!DOCTYPE html>
<html lang ="ja">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>
{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
header.jumbotron {
  background-image: url("{{ asset('storage') . '/' . 'ed3aa6898042aae09d4704308da74dbd.jpg' }}");
  background-position: center center;
  background-size: cover;
  padding: 5px 15px;
  color: #fff;
  width: 100%;
}

header .container {
  margin-top: 13%;
}

header .midashi-btn {
  border: 1px solid #fff;
  color: #fff;
  border-radius: 0;
}

header .midashi-btn:hover {
  color: #0089ff;
  border-color: #0089ff;
}

.navbar-form {
  padding-right: 30px;
}
</style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbarEexample8">
<span class="sr-only"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#" style="color:white;">

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
@if (!is_null(Auth::user()->email))
<li><a href="{{ route('edit_user_account', ['id'=>Auth::id()]) }}">ユーザー情報編集</a></li>
@endif
<li><a href="{{ route('logout') }}" class="ml-4">ログアウト</a></li>
@else
<li><a href="{{ route('home') }}">Login</a></li>
<li><a href="{{ route('register') }}">Register</a></li>
@endif
</ul>
@if (Auth::check())
<p class="navbar-text navbar-right">ようこそ {{ Auth::user()->name }} さん。</p>
@else
<p class="navbar-text navbar-right">ようこそ ゲストさん</p>
@endif
</div>
</div>
</nav>

<header class="jumbotron">
<div class="container">
<h1>旅を共にを作る</h1>
<h1>Where your travel begins??</h1>
<p>旅先ではもちろん、移動中も荷造りするときも欠かせない旅行用品。
便利な旅行グッズを事前に準備して、
旅をもっと快適に、もっと楽しく過ごしましょう!</p>
@if (Auth::check())
<p><a href="{{ route('settlement.index') }}" class="btn btn-lg midashi-btn" role="button">決済画面へ &raquo;</a></p>
@endif
</header>

<div class="album py-5 bg-light">
<div class="container">

<div class="row">
@foreach ($items as $item)
<div class="col-md-4 col-sm-6">
<span class="thumbnail">
<img class="rounded-circle card-img-top" src="{{ asset('storage') . '/' . $item->file_name }}">
<h4>{{ $item->item_name}}</h4>
<p style="word-wrap: break-word;">{{ $item->description }}</p>
<small class="text-muted">{{ $item->created_at }}</small>
<hr class="line">
<div class="row">
<div class="col-md-6 col-sm-6">
<p>価格 {{ $item->price }}円</p>
</div>
<div class="col-md-6 col-sm-6">
<a href ="{{ route('item.detail', ['id' => $item->id]) }}"><button type="button" class="btn btn-info">BUY NOW</button></a>
</div>
</div>
</span>
</div>
@endforeach
</div>
<div class="text-center">
{{ $items->links() }}
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</html>

