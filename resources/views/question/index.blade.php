@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<h1>All the questions</h1>
		</div>
		<div class="row">
			<div class="col-12">
				@foreach ($questions->chunk(3) as $questionchunck)
					<div class="card-deck">
						@foreach ($questionchunck as $question)
							<div class="card card__question">
								<div class="card-body">
									<h5 class="card-title"> {{ $question->title }} </h5>
									<p class="card-text .text-truncate"> {{ str_limit($question->question, 150) }} </p>
									@foreach($question->tags as $tag)
										<button class="btn btn-sm"> {{ $tag->name }} </button>
									@endforeach
									<br> <br>
									<a href=" {{ route('question.show', $question) }} " class="btn btn-outline-primary">view question</a>
								</div>
							</div>
						@endforeach
					</div>
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