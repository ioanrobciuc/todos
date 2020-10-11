<div class="header">
	<div class="left">
		<h2>{{ $title }}</h2>
		@if (!empty($subtitle))
			<p>{{ $subtitle }}</p>
		@endif
	</div>
	<div class="right">
		@if ($key === 0)
			<a href="{{ $button_url }}" title="{{ $button_text }}">{{ $button_text }}</a>
		@endif
	</div>
</div>
