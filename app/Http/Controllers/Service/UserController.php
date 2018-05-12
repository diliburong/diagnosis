<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\M3Result;
use App\User;
use Auth;


class UserController extends Controller
{
    public function userAdd(Request $request)
    {
        $name = $request->input('name', '');
        $email = $request->input('email', '');
        $role_id =$request->input('role_id', 1);

        $m3Result = new M3Result;

        if($name == '') {
            $m3Result->status = 1;
            $m3Result->message = '用户名不能为空';
            return $m3Result->toJson();
        }

        if($email == '') {
            $m3Result->status = 2;
            $m3Result->message = '邮箱不能为空';
            return $m3Result->toJson();
        }



        $newUser = new User;
        $newUser->role_id = $role_id;
        $newUser->name = $name;
        $newUser->email  =$email;
        $newUser->password = bcrypt('123456');
        $newUser->save();
        
        $m3Result->status = 0;
        $m3Result->message = '添加成功';
        
        return $m3Result->toJson();

    }

    public function userEdit(Request $request)
    {        
        $name = $request->input('name', '');
        $editId = $request->input('user_id', 0);
        $email = $request->input('email', '');
        $role_id =$request->input('role_id', 1);
        // $password = $request->input('password', '');

        $m3Result = new M3Result;

        if($name == '') {
            $m3Result->status = 1;
            $m3Result->message = '用户名不能为空';
            return $m3Result->toJson();
        }

        if($email == '') {
            $m3Result->status = 2;
            $m3Result->message = '邮箱不能为空';
            return $m3Result->toJson();
        }

        // if(password == '') {
        //     $m3Result->status = 3;
        //     $m3Result->message = '密码不能为空';
        //     return $m3Result->toJson();
        // }


        if(!User::find($editId)) {
            $m3Result->status = 4;
            $m3Result->message = "用户不存在";
            return $m3Result->toJson();
        }

        $editdUser = User::find($editId);

        if(Auth::user()->role_id > User::find($editId)->role_id) {
            $m3Result->status = 3;
            $m3Result->message = "无权限";
            return $m3Result->toJson();
        }

        $editdUser->name = $name;
        $editdUser->role_id =$role_id;
        $editdUser->email = $email;
        $editdUser->save();

        $m3Result->status = 0;
        $m3Result->message = "修改成功";
        return $m3Result->toJson();

    }

    public function userDel(Request $request)
    {
        $deleteId = $request->input('id', 0);

        $m3Result = new M3Result;
        
        if($deleteId == 0) {
            $m3Result->status = 1;
            $m3Result->message = "用户id不能为空";
            return $m3Result->toJson();
            
        }

        if(!User::find($deleteId)) {
            $m3Result->status = 2;
            $m3Result->message = "用户不存在";
            return $m3Result->toJson();
        }

        if(Auth::user()->id == $deleteId) {
            $m3Result->status = 3;
            $m3Result->message = "无法删除自身";
            return $m3Result->toJson();
        }

        $deletedUser = User::find($deleteId);

        if(Auth::user()->role_id > User::find($deleteId)->role_id) {
            $m3Result->status = 3;
            $m3Result->message = "无权限";
            return $m3Result->toJson();
        }

        

        $deletedUser->is_deleted = 1;
        $deletedUser->save();

        $m3Result->status = 0;
        $m3Result->message = "删除成功";
        return $m3Result->toJson();

    }

    public function myInfoEdit(Request $request)
    {
        $name = $request->input('name', '');
        $email = $request->input('email', '');

        $m3Result = new M3Result;

        if($name == '') {
            $m3Result->status = 1;
            $m3Result->message = '用户名不能为空';
            return $m3Result->toJson();
        }

        if($email == '') {
            $m3Result->status = 2;
            $m3Result->message = '邮箱不能为空';
            return $m3Result->toJson();
        }

        $user = Auth::user();

        $user->name = $name;
        $user->email = $email;

        $user->save();

        $m3Result->status = 0;
        $m3Result->message = '修改成功';
        
        return $m3Result->toJson();

    }
}
