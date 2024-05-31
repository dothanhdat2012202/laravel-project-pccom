<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Đăng nhập quản trị'
        ]);
    }

    // tạo thông báo cho phần đăng nhập admin
    public function store(Request $request) // request trả về cho sv
    {
        //dd($request->input());
        $this->validate($request, [
            'email' => 'required|email:filter' ,//email không được trống
            'password' =>'required'
        ]);

        if (Auth::attempt([
            'email' =>$request-> input('email'),   //check xem email có đúng trên database hay không
            'password' => $request -> input('password'),
            'role' => 1
        ], $request->input('remember')))
        {
            return redirect()->route('admin');
        }
        // tạo ra thông báo lỗi bằng seesion
        Session::flash('error','Thông tin đăng nhập không chính xác!');
        return redirect()->back();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->back();
    }
}
