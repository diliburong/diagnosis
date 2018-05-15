<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Patient;

class PatientController extends Controller
{
    public function __construct()
    {
        //会在控制器类生成对象后第一时间自动载入一个名为 auth 的中间件
        $this->middleware('auth');
    }

    public function toPatientList(Request $request)
    {
        $request->query('page', 'default');
        $searchName = '%'. $request->query('name', '') . '%';

        $patients = Patient::where('name', 'like',  $searchName)->paginate(10);
        return view('patients')->with('patients', $patients);
    }

    public function toPatientAdd()
    {
        return view('patient_add');
    }

    public function toPatientEdit(Request $request, $patientId)
    {
        $patient = Patient::find($patientId);
        return view('patient_edit')->with('patient', $patient);
    }
}
