<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:employees,phone_number',
            'email' => 'required|string|email|max:255|unique:employees,email',
        ]);
        return Employee::create($validated)->id;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->step=='one') {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'second_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255|unique:employees,phone_number,'.$id,
                'email' => 'required|string|email|max:255|unique:employees,email,'.$id,
            ]);
            Employee::where('id', $id)
            ->update($validated);
        } elseif ($request->step=='two') {
            $validated = $request->validate([
                'date_of_birth' => 'required|date',
                'salary' => 'required|numeric',
            ]);
            Employee::where('id', $id)
            ->update($validated);
        }
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id', $id)
            ->delete();
    }
}
