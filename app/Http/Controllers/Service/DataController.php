<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Diagonse;
use App\Entity\Patient;
use App\Entity\Mean;
use App\Model\M3Result;
use Auth;

class DataController extends Controller
{

    public function getPatientJudge()
    {
        $donePatient = Patient::where('status', 1)->count();
        $noDonePatient = Patient::where('status', 0)->count();
        
        return response()->json([
                'legend' => ['已诊断','未诊断' ],
                'data' =>array(array('value'=>$donePatient,'name'=> "已经诊断"),
                               array('value'=>$noDonePatient,'name'=> "未诊断")
                            )
            ]);
    }


    public function getPatientKind()
    {
        $means = Mean::all();
        $legend = array();

        $diagonses = Diagonse::all();

        $data = array();
        
        foreach ($means as $key => $item) {
            array_push($legend, $item->text);
        
            $dataItem = array();
            $dataItem['name'] = $item->text;
            $dataItem['value'] = 0;
            foreach ($diagonses as $diagonse) {
                if($diagonse->symptom_one == $item->s_one &&$diagonse->symptom_two == $item->s_two){
                    $dataItem['value']++;
                }
            }

            array_push($data, $dataItem);
        }

        return response()->json([
            'legend' => $legend,
            'data' => $data
        ]);

    }

}