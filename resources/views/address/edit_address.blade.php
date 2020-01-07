<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF トークン --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
{{-- フラッシュメッセージ --}}
<body class="text-center">
@if (session('flash_message'))
<div class="flash_message bg-danger text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<a href="{{ route('cart.index', ['id' => Auth::id()]) }}">カートへ戻る</a>
<form class="form-horizontal" method="POST" action="{{ route('address.add') }}">
{{ csrf_field() }}
<p>利用者名</p>
<input id="customer_name" name="customer_name" value="{{ $customer_name }}" ><br>
{{ $errors->first('customer_name') }}
<p>郵便番号</p>
<input id="postal_code1"  name="postal_code1" value="{{ $postal_code[0] }}" maxlength="3">
<input id="postal_code2"  name="postal_code2" value="{{ $postal_code[1] }}" maxlength="4"><br>
{{ $errors->first('postal_code1') }}
{{ $errors->first('postal_code2') }}
<p>都道府県</p>
<select name="pref">
@foreach ($prefectures as $pref)
{{-- 選択されている都道府県をセレクト状態にする --}}
<option value="{{ $pref->id  }} . {{ $pref->pref_name }}" <?php if ( $pref->id == $prefecture_id ) { echo 'selected="true"'; } ?>>{{ $pref->pref_name }}</option>
@endforeach
</select>
{{ $errors->first('pref') }}
<p>それ以下の住所</p>
<input id="city" name="address" value="{{ $city }}" ><br>
{{ $errors->first('address') }}
<p>電話番号</p>
<input id="phone_number" name="phone" value="{{ $phone_number }}" ><br>
{{ $errors->first('phone') }}
<br>
<input type="hidden" name="hidden_id" value="{{ $id }}">
<button type="submit" class="btn btn-primary">
変更
</button>
</body>
