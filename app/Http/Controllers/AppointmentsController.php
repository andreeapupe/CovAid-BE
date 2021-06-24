<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientIndex()
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JSONResponse
     */
    public function doctorIndex()
    {
        if( Auth::user()->role->name === 'patient' ) {
            abort(401, 'You are not authorized to access this endpoint.');
        }

        $appointments = Auth::user()->doctorAppointments()->get();

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Appointment $appointment)
    {
        $user = Auth::user();

        if( $appointment->patient_id != $user->id && $appointment->doctor_id != $user->id ) {
            abort(403, 'You are not allowed to modify other user\'s appointments');
        }

        if( $user->role->name === 'patient' ) {
            $request->validate([
                'details' => ['required', 'string'],
                'status' => ['prohibited']
            ]);

            $appointment->details = $request->details;
            $appointment->save();
        } else {
            $request->validate([
                'details' => ['prohibited'],
                'status' => ['required', 'string', Rule::in(['rejected', 'approved'])]
            ]);

            $appointment->status = $request->status;
            $appointment->save();
        }


        return response()->json([
            'message' => 'Appointment successfully updated.',
            'appointment' => $appointment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Appointment $appointment)
    {
        $user = Auth::user();
        
        if( $appointment->patient_id != $user->id && $appointment->doctor_id != $user->id ) {
            abort(403, 'You are not allowed to modify other user\'s appointments');
        }

        DB::table('appointment_symptom')->where('appointment_id', $appointment->id)->delete();

        $appointment->delete();

        return response()->json([
            'message' => 'Appointment successfully deleted'
        ]);
    }
}
