<div class="border"></div>
<div id="{{ sprintf('task-%s', $id) }}" class="task">
	<div class="task-circle"></div>
	<p class="task-description">{{ $description }}</p>
	<p class="task-hours-worked">{{ sprintf('%s hours', $hoursWorked) }}</p>
</div>
