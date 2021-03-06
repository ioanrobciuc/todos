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
	@if ($showForm === true)
		<form class="clearfix" method="POST" action="{{ route('tasks.store') }}">
			@csrf
			<input class="enter-task-here" name="description" type="text" placeholder="Enter task here..." value="" />
			<input class="enter-hours" name="hours-worked" type="text" placeholder="Enter hours..." value="">
			<button type="submit">Add task</button>
		</form>
	@endif
	<ul id="errors" class="{{ !empty($errors->any()) ? 'display-block' : 'display-none' }}">
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		@endif
	</ul>
@endsection
