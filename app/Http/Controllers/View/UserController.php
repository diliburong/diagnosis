<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //会在控制器类生成对象后第一时间自动载入一个名为 auth 的中间件
        $this->middleware('auth');
    }

    public function toUserList(Request $request)
    {
        $users = User::where('is_deleted', 0)->orderBy('created_at', 'asc')->paginate(10);
        return view('users')->with('users', $users);
    }

    public function toUserAdd()
    {
        return view('user_add');
    }

    public function toUserEdit(Request $request, $userId)
    {
        $user = User::find($userId);
        return view('user_edit')->with('user', $user);
    }

    public function toMyInfo()
    {

        $user = Auth::user();

        return view('myInfo')->with('user', $user);
    }

}
