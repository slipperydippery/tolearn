@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row"></div>
		<div class="row show-question--container">
			<div class="col-12">

				<show-question
					:question = " {{ $question }} "
				>
				</show-question>

			</div>
		</div>
	</div>
@stop

@section('additional-scripts')
@endsection