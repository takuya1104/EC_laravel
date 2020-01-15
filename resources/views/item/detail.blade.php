<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">

<title>Top Itemm</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
.navbar {
  background-color: #222;
}
.breadcrumb-list > li {
  font-size: 14px;
  list-style: none;
  display: inline;
}
.breadcrumb-list > li a:after {
  content: "/";
  vertical-align: middle;
  margin: 0 5px;
  color: #7a7a7a;
}
.action-wishlist:hover,
.action-wishlist:focus{
  color:#fff;
}
.add-to-cart.action-wishlist {
  width: 50px;
  text-align: center;
  padding: 0;
}
.add-to-cart.action-wishlist i {
  margin-right: 0px;
}
.product-add-to-cart .cart-title,
.product-add-to-cart .cart-title:hover,
.product-list-action .cart-title,
.product-list-action .cart-title:hover {
  background-color: transparent;
  border-bottom: none;
  color: inherit;
}
.product-add-to-cart .pro-add-btn i,
.product-list-action .pro-add-btn i {
  margin-right: 10px;
  font-size: 18px;
}
.add-to-cart {
  display: inline-block;
}
.action-wishlist:hover,
.action-wishlist:focus{
  color:#fff;
}
.add-to-cart.action-wishlist i {
  margin-right: 0px;
}
.product-add-to-cart {
  float: none;
}
.single-product-wishlist{
  display: inline-block;
  position: relative;
  margin-left: 20px;
}
.product-thumbnail .owl-nav  {display: none;}
.breadcrumb-area {
	padding: 30px 0;
	background-color: #f3f3f3;
}
.breadmome-name {
	color: #ff6a00;
	font-size: 24px;
	font-weight: 500;
	text-transform: capitalize;
	margin: 0 0 18px;
}
.breadcrumb-content > ul > li {
	display: inline-block;
	list-style: none;
	position: relative;
	font-size: 14px;
	color: #333;
}
.breadcrumb-content > ul > li.active{
	color: #ff6a00;
}
.breadcrumb-content > ul > li:after {
	content: "/";
	vertical-align: middle;
	margin: 0 5px;
	color: #7a7a7a;
}
.breadcrumb-content > ul > li:last-child:after{
	display: none;
}
.mt-80 { margin-top: 80px }.mb-80 { margin-bottom: 80px }
.single-product-name {
	font-size: 22px;
	text-transform: capitalize;
	font-weight: 900;
	color: #444;
	line-height: 24px;
	margin-bottom: 15px;
}
.single-product-reviews {
	margin-bottom: 10px;
}
.single-product-price {
	margin-top: 25px;
}
.single-product-action {
	margin-top: 30px;
	padding-bottom: 30px;
	border-top: 1px solid #ebebeb;
	float: left;
	width: 100%;
}
.product-discount {
	display: inline-block;
	margin-bottom: 20px;
}

.bottun-submit {
	background-color: #008bff;
}
.bottun-submit:hover {
	background: #ff6a00;
	border-color: #e96405;
}

.product-discount span.price {
	font-size: 28px;
	font-weight: 900;
	line-height: 30px;
	display: inline-block;
	color: #008bff;
}
.product-info {
	color: #333;
	font-size: 20px;
	font-weight: 400;
}
.product-info p {
	line-height: 30px;
	font-size: 14px;
	color: #333;
	margin-top: 30px;
}
.product-add-to-cart span.control-label {
	display: block;
	margin-bottom: 10px;
	text-transform: capitalize;
	color: #232323;
	font-size: 14px;
}
.product-add-to-cart {
	overflow: hidden;
	margin: 20px 0px;
	float: left;
	width: 100%;
}
.cart-plus-minus-box {
	border: 1px solid #e1e1e1;
	border-radius: 0;
	color: #3c3c3c;
	height: 49px;
	text-align: center;
	width: 50px;
	padding: 5px 10px;
}
.product-add-to-cart .cart-plus-minus {
	margin-right: 25px;
}
.cart-plus-minus {
	position: relative;
	width: 75px;
	float: left;
	padding-right: 25px;
}
.add-to-cart {
	background: #008bff;
	border: 0;
	border-bottom: 3px solid #0680e5;
	color: #fff;
	box-shadow: none;
	padding: 0 30px;
	border-radius: 3px;
	font-weight: 400;
	cursor: pointer;
	font-size: 14px;
	text-transform: capitalize;
	height: 50px;
	line-height: 50px;
}
.add-to-cart:hover {
	background: #ff6a00;
	border-color: #e96405;
}
</style>
<link href="https://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body style="font-size:14px;">

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
<li><a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所確認画面</a></li>
<li><a href="{{ route('settlement.index') }}">決済画面へ</a></li>
<li><a href="{{ route('settlement.confirm', ['id' => Auth::id()]) }}">決済履歴</a></li>
<li><a href="{{ route('logout') }}" class="ml-4">ログアウト</a></li>
@else
<li><a href="{{ route('home') }}">ログイン画面</a></li>
<li><a href="{{ route('register') }}">Register</a></li>
<li><a href="{{ route('twitter.login') }}">Twitter Login</a></li>
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

<div class="container">
<div class="single-product-area mt-80 mb-80">
<div class="row">
<div class="col-md-5">
<div class="product-details-large" id="ProductPhoto">
<img src="{{ asset('storage') . '/' . $item->file_name }}">

</div>
</div>
<div class="col-md-7">
<div class="single-product-content">
<input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
<div class="product-details">
<h1 class="single-product-name">{{ $item->item_name }}</h1>
<div class="single-product-reviews">
<span class="shopify-product-reviews-badge" data-id="1912078270534"></span>
</div>
<div class="product-sku">DATE: <span class="variant-sku">{{ $item->created_at }}</span></div>
<div class="single-product-price">
<div class="product-discount"><span  class="price" id="ProductPrice"><span class=money>{{ $item->price }}円</span></span></div>
</div>
<div class="product-info" style="word-wrap: break-word;">{{ $item->description }}</div>
<div class="single-product-action">
<style>.product-variant-option .selector-wrapper{display: none;}</style>
<div class="product-add-to-cart">
<div class="add text-center">
@if (Auth::check())
<!-- 在庫確認 -->
@if ($item->stock > 0)
<form class="form-horizontal" method="POST" action="{{ route('cart.add_item') }}">
{{ csrf_field() }}
<input type="hidden" name="hidden_item_id" value="{{ $item->id }}" class="add-to-cart">
<td><input class="btn-info" type="submit" value="BUY"></td>
</form>
@else
<td>在庫なし</td>
@endif
@else
<td>ログイン後に購入可能です</td>
@endif
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</html>
