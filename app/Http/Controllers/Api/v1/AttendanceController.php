<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = [1,2,3];
        $attendance = Attendance::all();
        $gender = $attendance->countBy('gender');
        $gradeResult = $attendance->countBy('grade');
        return response()->json([
            "status" => 200,
            "data" => [
                'Male' => $gender->get('Male'),
                'Female' => $gender->get('Female'),
                'Grade 3' => $gradeResult->get('3'),
                'Grade 4' => $gradeResult->get('4'),
                'Grade 5' => $gradeResult->get('5')
            ]
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $data = $request->validated();
        $user = Attendance::create($data);

        if(!$user){
            return response()->failed('Data Failed to Insert');
        }else {
            return response()->success('Data Inserted Successfully', new AttendanceResource($user));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::find($id);

        if(empty($attendance)){
            return response()->empty();
        }

        return response()->success('Data Successfully Fetched', new AttendanceResource($attendance));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, string $id)
    {
        $data = $request->validated();
        $attendance = Attendance::find($id);

        if(empty($attendance)){
            return response()->empty();
        }

        $attendance->update($data);

        if(!$attendance){
            return response()->failed('Failed to Update Data');
        }else {
            return response()->success('Data Updated Successfully', new AttendanceResource($attendance));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);
        if(empty($attendance)){
            return response()->empty();
        }
        if(!$attendance){
            return response()->failed('Failed to Delete Data');
        }else {
            return response()->deleted();
        }
    }

    public function reset()
    {
        $attendance = Attendance::truncate();
        if($attendance){
            return response()->deleted('Data Deleted Successfully');
        }else {
            return response()->error('Data Failed to Delete');
        }
    }
}
