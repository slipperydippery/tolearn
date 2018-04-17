@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row"></div>
		<div class="row show-question--container">
			<div class="col-12">
				@php
					$guest = Auth::check() ? 0 : 1;
					$scorecardid = isset($scorecard) ? $scorecard->id : '0';
				@endphp

				<div class="row">
					<div class="col-12 main-container">
						<div class="row main-container--head">
							<div class="col-12">
								<h3> 
									{{ $question->title }} 
									@if ($question->user == Auth::user())
										<a href=" {{ route('question.edit', $question) }} " class="ml-3"><i class="material-icons material-icons--h3">edit</i></a>
									@endif
								</h3>
							</div>
						</div>
					</div>
				</div>

				<show-question
					:question = " {{ $question }} "
					:guest = " {{ $guest }} "
					:scorecardid = " {{ $scorecardid }} "
				>
				</show-question>
			</div>
		</div>
	</div>
@stop

@section('additional-scripts')
@endsection