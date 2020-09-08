<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('user.index', compact('users'));
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function useredit(User $user)
    {
        return view('user.useredit', compact('user'));
    }

    public function userupdate(Request $request)
    {
        $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(route('user.index'))->with('success', '修改密码成功');
    }

    public function update(Request $request)
    {
        $validated_data = $request->validate([
            'old_password' => 'password',
            'password' => 'required',
        ]);

        Auth::user()->update([
            'password' => bcrypt($validated_data['password'])
        ]);

        return redirect(route('user.index'))->with('success', '修改密码成功');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);
        return redirect(route('user.index'))->with('success', '创建用户成功');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'code' => 0,
            'message' => '删除用户成功'
        ]);
    }
}
