@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				@if (session('flash_message'))
					<div class="flash_message bg-danger text-center py-3 my-0">
					{{ session('flash_message') }}
					</div>
				@endif
				<div class="panel-heading">Dashboard</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

