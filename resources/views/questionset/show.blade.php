@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			{{ $questionset }}
		</div>
	</div>
@stop

@section('additional-scripts')
@endsection