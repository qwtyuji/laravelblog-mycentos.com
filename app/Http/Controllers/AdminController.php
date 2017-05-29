<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * AdminCotroller constructor.
     * @param $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info()
    {
        $info = auth('admin')->user();
        return view('admin.info', compact('info'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword()
    {
        $info = auth('admin')->user();
        return view('admin.resetpassword', compact('info'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPasswordStore(Request $request)
    {
        $info = auth('admin')->user();
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => '密码必须填写',
            'password.min' => '密码不能少于6位',
            'password.confirmed' => '两次密码输入不一样,请重新输入',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $info->update($data);
        return redirect()->action('AdminController@info');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateInfo()
    {
        $info = auth('admin')->user();
        return view('admin.updateinfo', compact('info'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfoStore(Request $request)
    {
        $info = auth('admin')->user();
        $this->validate($request, [
            'name' => 'required|min:3|unique:admins,name,' . $info->id,
            'email' => 'required|email|unique:admins,email,' . $info->id,
        ], [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能少于三个字符',
            'name.unique' => '用户名不能重复',
            'email.email' => '不是有效的邮箱地址',
            'email.required' => '邮箱地址不能为空',
            'email.unique' => '邮箱已注册',
        ]);
        $data = $request->all();
        $info->update($data);
        return redirect()->action('AdminController@info');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->admin->get();
        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        is_null($data['avatar']) ? $data['avatar'] = '/images/avatar/default.png' : '';
        $this->admin->create($data);
        return redirect()->action('AdminController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = $this->admin->find($id);
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = $this->admin->find($id);
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ], [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能少于三个字符',
            'name.unique' => '用户名不能重复',
            'email.email' => '不是有效的邮箱地址',
            'email.required' => '邮箱地址不能为空',
            'email.unique' => '邮箱已注册',
        ]);
        $data = $request->all();
        if (is_null($data['password'])){
           unset($data['password']);
        }else{
            $this->validate($request,[
                'password'=>'min:6',
            ],[
                'password.min'=>'密码长度不能少于6位',
            ]);
            $data['password'] = bcrypt($data['password']);
        }
        $user = $this->admin->find($id);
        $user->update($data);
        return redirect()->action('AdminController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->admin->find($id);
        $user->delete();
        return redirect()->action('AdminController@index');
    }
}
