<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Diagonse;
use App\Entity\Patient;
use App\Model\M3Result;
use Auth;

class DiagonseController extends Controller
{
    public function diagonseAdd(Request $request)
    {
        $patientId = $request->input('patientId', 0);
        $symptomOne = $request->input('symptomOne', 0);
        $symptomTwo = $request->input('symptomTwo', 0);
        $summary = $request->input('summary', '');
        $preview = $request->input('preview', '');


        $m3Result = new M3Result();
        if($patientId == 0) {
            $m3Result->status = 1;
            $m3Result->message = '病人id不能为空';
            return $m3Result->toJson();
        }

        if($symptomOne == 0) {
            $m3Result->status = 1;
            $m3Result->message = '舌质不能为空';
            return $m3Result->toJson();
        }

        if($symptomTwo == 0) {
            $m3Result->status = 1;
            $m3Result->message = '舌苔不能为空';
            return $m3Result->toJson();
        }

        if($summary == '') {
            $m3Result->status = 1;
            $m3Result->message = '总结不能为空';
            return $m3Result->toJson();
        }

        if($preview == '') {
            $m3Result->status = 1;
            $m3Result->message = '缩略图不能为空';
            return $m3Result->toJson();
        }


        $newDiagonse = new Diagonse();
        $newDiagonse->patient_id = $patientId;
        $newDiagonse->doctor_id = Auth::user()->id;
        $newDiagonse->parent_id = 0;
        $newDiagonse->img_path = $preview;
        $newDiagonse->symptom_one = $symptomOne;
        $newDiagonse->symptom_two = $symptomTwo;
        $newDiagonse->summary = $summary;

        $newDiagonse->save();

        $patient = Patient::find($patientId);
        $patient->status = 1;
        $patient->save();

        $m3Result->status = 0;
        $m3Result->message = '添加成功';
        return $m3Result->toJson();
        
    }
}
