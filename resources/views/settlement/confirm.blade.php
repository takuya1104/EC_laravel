<head>
<title>Settlement</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
<li><a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所確認画面</a></li>
<li><a href="{{ route('settlement.index') }}">決済画面</a></li>
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
<div class="flash_message bg-info text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif

@if ($purchase_infos->isEmpty())
<p class="text-center">{{ '過去の購入はありません' }}</p>
@else
<table class="table">
@foreach ($purchase_infos as $purchase)
@if ($purchase->getPurchases->isNotEmpty())
<tr>
<th>購入日時</th>
<th>都道府県</th>
<th>都市</th>
<th>郵便番号</th>
<th>合計金額</th>
</tr>
<tr>
<td>{{ date('Y-m-d', strtotime($purchase->created_at)) }}</td>
<td>{{ $purchase->prefecture->pref_name }}</td>
<td>{{ $purchase->city }}</td>
<td>{{ $purchase->postal_code }}</td>
<td>{{ $purchase->amount }}</td>
</tr>
<th>商品名</th>
<th>個数</th>
<th>金額</th>
<th>キャンセル</th>
@foreach ($purchase->getPurchases as $item)
<tr>
<td class="col-sm-8 col-md-6">
<div class="media">
<a class="thumbnail pull-left" href="{{ route('item.detail', ['id' => $item->id]) }}"> <img class="media-object" src="{{ asset('storage') . '/' . $item->file_name }}" style="width: 72px; height: 72px;"> </a>
<div class="media-body">
<h4 class="media-heading"><a href="{{ route('item.detail', ['id' => $item->id]) }}">{{ $item->item_name }}</a></h4>
<p>{{ $item->description }}</p>
</div>
</div>
</td>
<td class="col-sm-1 col-md-1" style="text-align: center">
{{ $item->pivot->item_amount }}
</td>
<td class="col-sm-1 col-md-1 text-center"><strong>{{ $item->price }}</strong></td>
<td class="col-sm-1 col-md-1">
@if ($item->pivot->status_id == '0')
<form method="POST" action="{{ route('settlement.cancel') }}">
{{ csrf_field() }}
<button class="btn btn-default">キャンセル</button>
<input type="hidden" name="purchase_id" value="{{ $item->id }} . {{ $purchase->id }}"></input>
</form>
@elseif ($item->pivot->status_id == '1')
{{ 'キャンセル済み' }}
@elseif ($item->pivot->status_id == '2')
{{ '配送中' }}
@else
{{ '配送済み' }}
@endif
</td>
</tr>
</tr>
@endforeach
@endif
@endforeach
</table>
@endif
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
