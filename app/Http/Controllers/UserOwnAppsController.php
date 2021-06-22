<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOwnAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if( Auth::user()->role->name === 'doctor' ) {
            abort(401, 'You are not authorized to access this endpoint.');
        }

        $appointments = Auth::user()->patientAppointments()->get();

        return response()->json([
            'appointments' => $appointments->load('patient')->load('doctor')->load('symptoms')
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => ['required', 'integer', 'exists:users,id'],
            'contact' => ['required', 'boolean'],
            'details' => ['string'],
            'symptoms' => ['required', 'array'],
            'symptoms.*' => ['integer', 'exists:symptoms,id']
        ]);

        $appoinment = Appointment::create([
            'patient_id' => Auth::user()->id,
            'doctor_id' => $request->doctor_id,
            'contact' => $request->contact,
            'details' => $request->details
        ]);

        $appoinment->symptoms()->attach($request->symptoms);


        return response()->json([
            'message' => 'Appointment successfully created.',
            'appointment' => $appoinment->refresh()->load('symptoms')->load('patient')->load('doctor')
        ], 201);
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
