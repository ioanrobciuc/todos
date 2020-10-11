@extends('layout')

@section('content')
	@foreach ($data as $key => $value)
		<div class="tasks-group">
			@include('components.header', [
				'key' => $key,
				'title' => $value->header->title,
				'subtitle' => $value->header->subtitle,
				'button_text' => $value->header->button_text,
				'button_url' => $value->header->button_url
			])
			@foreach ($value->tasks as $task)
				@include('components.task', [
					'id' => $task->id,
					'description' => $task->description,
					'hoursWorked' => $task->hours_worked
				])
			@endforeach
		</div>
	@endforeach
@endsection
