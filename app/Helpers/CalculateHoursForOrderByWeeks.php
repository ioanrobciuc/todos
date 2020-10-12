<?php

namespace App\Helpers;

class CalculateHoursForOrderByWeeks
{
	/**
	 *	All tasks.
	 *
	 *	@var null|\Illuminate\Database\Eloquent\Collection
	 */
	private $tasks = null;

	/**
	 *	Construct.
	 *
	 *	@param \Illuminate\Database\Eloquent\Collection $tasks
	 */
	public function __construct(\Illuminate\Database\Eloquent\Collection $tasks)
	{
		$this->tasks = $tasks;
	}
}
