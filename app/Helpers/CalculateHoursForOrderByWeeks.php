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
	 *	Number of weeks.
	 *
	 *	@var int
	 */
	private $numberOfWeeks = 0;

	/**
	 *	Data.
	 *
	 *	@var array
	 */
	private $data = [];

	/**
	 *	Ignore tasks.
	 *
	 *	@var array
	 */
	private $ignoreTasks = [];

	/**
	 *	Construct.
	 *
	 *	@param \Illuminate\Database\Eloquent\Collection $tasks
	 */
	public function __construct(\Illuminate\Database\Eloquent\Collection $tasks)
	{
		$this->tasks = $tasks;

		$this->setNumberOfWeeks();
		$this->setDataWithEmptyWeeks();
		$this->calculateAndSetNewData();
	}

	/**
	 *	Get Data.
	 *
	 *	@return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 *	Generate number of weeks.
	 *
	 *	@return void
	 */
	private function setNumberOfWeeks()
	{
		$hoursWorked = 0;

		foreach ($this->tasks as $task) {
			$hoursWorked += $task->hours_worked;
		}

		$this->numberOfWeeks = (int) ceil($hoursWorked / 40);
	}

	/**
	 *	Set data with empty weeks.
	 *
	 *	@return void
	 */
	private function setDataWithEmptyWeeks()
	{
		for ($i = 0; $i < $this->numberOfWeeks; $i++) {
			$this->data[] = (object) [
				'header' => (object) [
					'title' => sprintf('Week #%s', $i + 1),
					'subtitle' => '0 - hours',
					'button_text' => 'Go back',
					'button_url' => route('tasks.index')
				],
				'tasks' => []
			];
		}
	}

	/**
	 *	Calculate and set new data.
	 *
	 *	@return void
	 */
	private function calculateAndSetNewData()
	{
		foreach ($this->data as &$data) {
			$subtitleHoursWorked = (int) explode('-', $data->header->subtitle)[0];

			foreach ($this->tasks as $task) {
				if (!in_array($task->id, $this->ignoreTasks)) {
					$sum = $subtitleHoursWorked + $task->hours_worked;
					if ($sum <= 40) {
						$this->ignoreTasks[] = $task->id;
						$subtitleHoursWorked = $sum;
						$data->header->subtitle = sprintf('%s - Hours', $subtitleHoursWorked);
						$data->tasks[] = $task;
					}
				}
			}
		}

		unset($data);
	}
}
