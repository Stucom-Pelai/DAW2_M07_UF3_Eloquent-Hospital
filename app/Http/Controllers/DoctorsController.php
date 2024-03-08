<?php
namespace App\Http\Controllers;
use App\Models\doctor;
class DoctorsController {

public function getAllDoctors(){
    // $doctors = doctor::all()->toArray();
    $doctors = doctor::with('employee')->get();

    try{
        return response()->json($doctors);
    }catch(\Exception $e){
        return response()->
        json(['action' => 'get', 'status' => false, 'error' => $e->getMessage()]);
    }

}

}