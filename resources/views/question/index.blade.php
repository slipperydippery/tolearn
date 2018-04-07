@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h1>All the questions</h1>
		</div>
		<div class="row">
			<div class="col-12">
				@foreach ($questions as $question)
					{{ $question->title }}
				@endforeach
			</div>
			<div class="col-12">
				<a href=" {{ URL::route('question.create') }} " class="btn btn-primary">Add another question</a>
			</div>
		</div>
	</div>
@stop

@section('additional-scripts')
@endsection