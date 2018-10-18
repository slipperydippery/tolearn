@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h1 class="oversized">New</h1>
		</div>
		<div class="row"></div>
		<div class="row edit-question--container">
			<div class="col-12">
				<div class="row edit--question--followup main-container--head">
					@if ($question->parent)
						<div class="col followup--parent col-auto mr-auto"> <a href=" {{ route('question.edit', $question->parent) }} " class="btn btn-outline-dark btn-outline-nooutline"> << Edit Parent </a> </div>
					@else
						<div class="col followup--parent col-auto mr-auto"> <a href=" {{ route('question.followup.storeparent', $question) }} " class="btn btn-outline-dark btn-outline-nooutline"> << Create Parent </a> </div>
					@endif
					@if ($question->followup)
						<div class="col followup--child ml-auto col-auto"> <a href=" {{ route('question.edit', $question->followup) }} " class="btn btn-outline-dark btn-outline-nooutline"> Edit followup >> </a> </div>
					@else
						<div class="col followup--child ml-auto col-auto"> <a href=" {{ route('question.followup.storefollowup', $question) }} " class="btn btn-outline-dark btn-outline-nooutline"> Create Followup >> </a> </div>
					@endif
				</div>
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