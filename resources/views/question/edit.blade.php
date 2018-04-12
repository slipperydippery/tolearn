@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h1>Let's create a question</h1>
		</div>
		<div class="row"></div>
		<div class="row edit-question--container">
			<div class="col-12">
				@if ($question->followup || $question->parent)
					<div class="row edit--question--followup">
						@if ($question->parent)
							<div class="col followup--parent col-auto mr-auto"> <a href=" {{ route('question.edit', $question->parent) }} " class="btn btn-outline-secondary btn-outline-nooutline"> << Parent </a> </div>
						@endif
						@if ($question->followup)
							<div class="col followup--child ml-auto col-auto"> <a href=" {{ route('question.edit', $question->followup) }} " class="btn btn-outline-secondary btn-outline-nooutline"> Child >> </a> </div>
						@endif
					</div>
				@endif
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