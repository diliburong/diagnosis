<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Entity\Patient;
use App\Model\M3Result;

class PatientController extends Controller
{
    public function patientAdd(Request $request)
    {
        $name = $request->input('name', '');
        $phone = $request->input('phone', '');
        $age = $request->input('age', 1);
        $sex  = $request->input('sex', 1);

        $m3Result = new M3Result;

        if($name == '') {
            $m3Result->status = 1;
            $m3Result->message = '病人名不能为空';
            return $m3Result->toJson();
        }

        if($phone == '') {
            $m3Result->status = 2;
            $m3Result->message = '手机不能为空';
            return $m3Result->toJson();
        }


        $newPatient = new Patient;
        $newPatient->sex = $sex;
        $newPatient->name = $name;
        $newPatient->phone  =$phone;
        $newPatient->save();
        
        $m3Result->status = 0;
        $m3Result->message = '添加成功';
        
        return $m3Result->toJson();

    }

    public function patientEdit(Request $request)
    {        
        $name = $request->input('name', '');
        $phone = $request->input('phone', '');
        $age = $request->input('age', 1);
        $sex  = $request->input('sex', 1);
        $editId = $request->input('id', 1);

        $m3Result = new M3Result;

        if($name == '') {
            $m3Result->status = 1;
            $m3Result->message = '病人名不能为空';
            return $m3Result->toJson();
        }

        if($phone == '') {
            $m3Result->status = 2;
            $m3Result->message = '手机不能为空';
            return $m3Result->toJson();
        }

        if(!Patient::find($editId)) {
            $m3Result->status = 4;
            $m3Result->message = "病人不存在";
            return $m3Result->toJson();
        }

        $editdPatient = Patient::find($editId);

        $editdPatient->name = $name;
        $editdPatient->phone =$phone;
        $editdPatient->age = $age;
        $editdPatient->sex = $sex;
        $editdPatient->save();

        $m3Result->status = 0;
        $m3Result->message = "修改成功";
        return $m3Result->toJson();

    }

    public function patientDel(Request $request)
    {
        $deleteId = $request->input('id', 0);

        $m3Result = new M3Result;
        
        if($deleteId == 0) {
            $m3Result->status = 1;
            $m3Result->message = "用户id不能为空";
            return $m3Result->toJson();
            
        }

        if(!Patient::find($deleteId)) {
            $m3Result->status = 2;
            $m3Result->message = "用户不存在";
            return $m3Result->toJson();
        }

        $deletedPatient = Patient::find($deleteId);

        // TODO.
        $deletedPatient->delete();
        // $deletedPatient->save();

        $m3Result->status = 0;
        $m3Result->message = "删除成功";
        return $m3Result->toJson();

    }
}
