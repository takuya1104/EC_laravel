<!DOCTYPE html>
<html lang ="ja">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
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
<th>現在のステータス</th>
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

@if ($item->pivot->status_id == '1')
{{ 'キャンセル済み' }}
@else
<form method="POST" action="{{ route('member.status') }}">
{{ csrf_field() }}
<button class="btn btn-default">キャンセル可</button>
<input type="hidden" name="purchase_id" value="{{ $item->pivot->id }}"></input>
<input type="hidden" name="purchase_status" value="0"></input>
</form>

<form method="POST" action="{{ route('member.status') }}">
{{ csrf_field() }}
<button class="btn btn-default">配送中</button>
<input type="hidden" name="purchase_id" value="{{ $item->pivot->id }}"></input>
<input type="hidden" name="purchase_status" value="2"></input>
</form>

<form method="POST" action="{{ route('member.status') }}">
{{ csrf_field() }}
<button class="btn btn-default">配送済み</button>
<input type="hidden" name="purchase_id" value="{{ $item->pivot->id }}"></input>
<input type="hidden" name="purchase_status" value="3"></input>
</form>
@endif
@if ($item->pivot->status_id == '0')
<td class="col-sm-1 col-md-1">{{ 'キャンセル可能' }}</td>
@elseif ($item->pivot->status_id == '1')
<td class="col-sm-1 col-md-1">{{ 'キャンセル済み' }}</td>
@elseif ($item->pivot->status_id == '2')
<td class="col-sm-1 col-md-1">{{ '配送中' }}</td>
@else
<td class="col-sm-1 col-md-1">{{ '配送済み' }}</td>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>

