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

<form class="form-horizontal" method="POST" action="{{ route('address.add') }}">
{{ csrf_field() }}
<p>利用者名</p>
<input id="customer_name" name="customer_name" value="{{ old('customer_name') }}"><br>
{{ $errors->first('customer_name') }}
<p>郵便番号</p>
<input id="postal1" name="postal_code1" value="{{ old('postal_code1') }}" maxlength="3">-<input id="postal2" name="postal_code2" value="{{ old('postal_code2') }}" maxlength="4"><br>
{{ $errors->first('postal_code1') }}
{{ $errors->first('postal_code2') }}
<p>都道府県</p>
<select name="pref">
@foreach ($prefectures as $prefecture)
<option value="{{ $prefecture->id  }} . {{ $prefecture->pref_name }}">{{ $prefecture->pref_name }}</option>
@endforeach
</select>
{{ $errors->first('pref') }}
<p>それ以下の住所</p>
<input id="address" name="address" value="{{ old('address') }}"><br>
{{ $errors->first('address') }}
<p>電話番号</p>
<input id="address" name="phone" value="{{ old('phone') }}"><br>
{{ $errors->first('phone') }}
<br>
<button type="submit" class="btn btn-primary">
変更
</button>
