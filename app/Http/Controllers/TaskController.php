<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as EmployeeModel;
use App\Models\EmployeeTask as EmployeeTaskModel;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employeeId = EmployeeModel::first()->id;

        $orderBy = $request->get('order-by');
        $orderByWeeks = !empty($orderBy) && $orderBy === 'weeks' ? true : false;

        return view('tasks', [
            'data' => $this->processingData($employeeId, $orderByWeeks),
            'showForm' => !$orderByWeeks
        ]);
    }

    private function processingData(int $employeeId, bool $orderByWeeks)
    {
        if ($orderByWeeks === true) {
            $data = [
                0 => (object) [
                    'header' => (object) [
                        'title' => 'Week 1',
                        'subtitle' => '40 - Hours',
                        'button_text' => 'Go back',
                        'button_url' => route('tasks.index')
                    ],
                    'tasks' => EmployeeTaskModel::where('employee_id', '=', $employeeId)->get()
                ],
                1 => (object) [
                    'header' => (object) [
                        'title' => 'Week 2',
                        'subtitle' => '40 - Hours',
                        'button_text' => 'Go back',
                        'button_url' => route('tasks.index')
                    ],
                    'tasks' => EmployeeTaskModel::where('employee_id', '=', $employeeId)->get()
                ],
                2 => (object) [
                    'header' => (object) [
                        'title' => 'Week 3',
                        'subtitle' => '40 - Hours',
                        'button_text' => 'Go back',
                        'button_url' => route('tasks.index')
                    ],
                    'tasks' => EmployeeTaskModel::where('employee_id', '=', $employeeId)->get()
                ],
                3 => (object) [
                    'header' => (object) [
                        'title' => 'Week 4',
                        'subtitle' => '40 - Hours',
                        'button_text' => 'Go back',
                        'button_url' => route('tasks.index')
                    ],
                    'tasks' => EmployeeTaskModel::where('employee_id', '=', $employeeId)->get()
                ]
            ];
        } else {
            $data = [
                0 => (object) [
                    'header' => (object) [
                        'title' => 'Tasks',
                        'subtitle' => '',
                        'button_text' => 'Organize tasks',
                        'button_url' => sprintf('%s?order-by=weeks', route('tasks.index'))
                    ],
                    'tasks' => EmployeeTaskModel::where('employee_id', '=', $employeeId)->get()
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
        //
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
