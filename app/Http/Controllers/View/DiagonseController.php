<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Diagonse;
use App\Entity\Symptom;
use App\Entity\Patient;
use Illuminate\Support\Facades\DB;
use App\Entity\Mean;

class DiagonseController extends Controller
{
    public function __construct()
    {
        //会在控制器类生成对象后第一时间自动载入一个名为 auth 的中间件
        $this->middleware('auth');
    }

    public function toDiagonse($patientId)
    {

        $diagonses = Diagonse::where('patient_id', $patientId)->get();

        foreach ($diagonses as $key => $diagonse) {
            # code...
            $mean = Mean::where(['s_one'=>$diagonse->symptom_one,'s_two'=>$diagonse->symptom_two])->first()->text;
            $diagonse->mean = $mean;
        }

        $patient = Patient::find($patientId);

        return view('diagonses')->with('diagonses', $diagonses)
                                ->with('patient',  $patient);
    }

    public function toDiagonseAdd($patientId)
    {
        $symptoms = Symptom::where('parent_id', 0)->get();
       $patient = Patient::find($patientId);
        return view('diagonse_add')->with('symptoms', $symptoms)
                                    ->with('patient',  $patient);
    }
}
