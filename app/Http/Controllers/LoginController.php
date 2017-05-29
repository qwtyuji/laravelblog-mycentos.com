<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard/home';

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'logout']);

    }

    /**
     * 重写验证表单字段
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * 显示登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login.login');
    }

    /**
     * 使用admin guard
     * @return mixed
     */
    public function guard()
    {
        return auth()->guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->action('LoginController@login');
    }

}

