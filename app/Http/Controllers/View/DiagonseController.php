<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Diagonse;
use App\Entity\Symptom;

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
        

        return view('diagonses')->with('diagonses', $diagonses);
    }

    public function toDiagonseAdd()
    {
        $symptoms = Symptom::whereNull('parent_id')->get();
        return view('diagonse_add')->with('symptoms', $symptoms);

    }
}
