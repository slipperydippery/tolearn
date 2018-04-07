@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h1>Let's create a question</h1>
		</div>
		<div class="row">
			<div class="col-12">
				<edit-question
					:initquestion = " {{ $question }} "
				>
				</edit-question>
			</div>
		</div>
	</div>
@stop

@section('additional-scripts')
@endsection