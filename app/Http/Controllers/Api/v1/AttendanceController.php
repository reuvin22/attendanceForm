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
        $grades = [1, 2, 3];
        $attendance = Attendance::whereIn('grade', $grades)->get();
        $allGrades = $attendance->countBy('grade');
        $allGender = $attendance->countBy('gender');

        return response()->json([
            'status' => 200,
            'data' => [
                'data' => now(),
                'Male' => $allGender->get('Male', 0),
                'Female' => $allGender->get('Female', 0),
                'Grade 1' => $allGrades->get(1, 0),
                'Grade 2' => $allGrades->get(2, 0),
                'Grade 3' => $allGrades->get(3, 0)
            ]
        ]);

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
}
