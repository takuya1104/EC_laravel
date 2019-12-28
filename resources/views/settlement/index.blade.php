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

<a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カートの中身を見る</a>
<a href="{{ route('address.confirm', ['id' => Auth::id()]) }}">住所選択画面</a>
<form action="{{ route('settlement.payment') }}" method="POST">
{{ csrf_field() }}
<table>
<span>氏名</span>
<span>郵便番号</span>
<span>都道府県</span>
<span>それ以下の住所</span>
<span>電話番号</span>
@if (!$registered_address->isEmpty())
@foreach ($registered_address as $address)
<tr>
<td>{{ $address->customer_name }}<td>
<td>{{ $address->postal_code }}<td>
<td>{{ $address->prefecture->pref_name }}<td>
<td>{{ $address->city }}<td>
<td>{{ $address->phone_number }}<td>
<td><input type="checkbox" name="deliver_address[]" value="{{ $address->id }}"><td>
</tr>
@endforeach
</table>
@else
<p>住所登録がありません</p>
@endif

@if (!$items_in_carts->isEmpty())
<table>
<span>商品名</span>
<span>個数</span>
<span>金額</span>
@foreach ($items_in_carts as $cart)
<tr>
<td>{{ $cart->item->item_name }}<td>
<td>&nbsp;&nbsp;{{ $cart->item_amount }}<td>
<td>&nbsp;&nbsp;{{ $cart->item->price }}<td>
</tr>
@endforeach
</table>
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="{{ env('STRIPE_KEY') }}"
data-amount="{{ $total_price }}"
data-user="1"
data-name="決済テスト"
data-label="決済へ"
data-description="procir.siteの会計画面です"
data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
data-locale="auto"
data-currency="JPY">
</script>
@else
<p>カートに商品がありません</p>
@endif
</form>
