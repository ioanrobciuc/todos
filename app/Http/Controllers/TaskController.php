<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as EmployeeModel;
use App\Models\EmployeeTask as EmployeeTaskModel;
use App\Helpers\CalculateHoursForOrderByWeeks;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderBy = $request->get('order-by');
        $orderByWeeks = !empty($orderBy) && $orderBy === 'weeks' ? true : false;

        return view('tasks', [
            'data' => $this->processingData(EmployeeModel::first()->id, $orderByWeeks),
            'showForm' => !$orderByWeeks
        ]);
    }

    /**
     *  Processing data.
     *
     *  @return array
     */
    private function processingData(int $employeeId, bool $orderByWeeks)
    {
        $tasks = EmployeeTaskModel::where('employee_id', '=', $employeeId);
        $data = [];

        if ($orderByWeeks === true) {
            $calculateHoursForOrderByWeeks = new CalculateHoursForOrderByWeeks($tasks->orderBy('hours_worked', 'DESC')->get());
            $data = $calculateHoursForOrderByWeeks->getData();
        } else {
            $data = [
                0 => (object) [
                    'header' => (object) [
                        'title' => 'Tasks',
                        'subtitle' => '',
                        'button_text' => 'Organize tasks',
                        'button_url' => sprintf('%s?order-by=weeks', route('tasks.index'))
                    ],
                    'tasks' => $tasks->orderBy('id', 'DESC')->get()
                ]
            ];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'hours-worked' => 'required|integer|min:1|max:20'
        ]);

        $employeeTask = new EmployeeTaskModel;
        $employeeTask->employee_id = EmployeeModel::first()->id;
        $employeeTask->hours_worked = $request->post('hours-worked');
        $employeeTask->description = $request->post('description');
        $employeeTask->save();

        return redirect()->action([\App\Http\Controllers\TaskController::class, 'index'], []);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
