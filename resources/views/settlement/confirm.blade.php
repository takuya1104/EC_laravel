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
<body class="text-center">
<a href="{{ route('item.index') }}">ホームへ戻る</a>
<a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所選択画面</a>
<a href="{{ route('settlement.index') }}">決済画面へ</a>
<br>
@if ($purchase_infos->isEmpty())
<p>{{ '過去の購入はありません' }}</p>
@else
<table class="table">
<th>購入日時</th>
<th>都道府県</th>
<th>都市</th>
<th>郵便番号</th>
<th>合計金額</th>
@foreach ($purchase_infos as $purchase)
@if ($purchase->getItems->isNotEmpty())
<tr>
<td>{{ date('Y-m-d', strtotime($purchase->created_at)) }}</td>
<td>{{ $purchase->prefecture->pref_name }}</td>
<td>{{ $purchase->city }}</td>
<td>{{ $purchase->postal_code }}</td>
<td>{{ $purchase->amount }}</td>
</tr>
@foreach ($purchase->getItems as $item)
<tr>
<td>{{ $item->item_name }}</td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
@if (\Carbon\Carbon::parse($purchase->created_at)->addDays(2) > \Carbon\Carbon::today())
<form method="POST" action="{{ route('settlement.cancel') }}">
{{ csrf_field() }}
<td><input type="submit" value="キャンセル"></input></td>
<td><input type="hidden" name="purchase_id" value="{{ $purchase->purchase->id }} . {{ $purchase->id }}"></input></td>
</form>
@elseif (\Carbon\Carbon::parse($purchase->created_at)->addDays(5) < \Carbon\Carbon::today())
<td>{{ '配送済み' }}</td>
@else
<td>{{ '配送中' }}</td>
@endif
</tr>
@endforeach
@endif
@endforeach
</table>
@endif
</body>
