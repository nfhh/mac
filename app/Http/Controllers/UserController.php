<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit');
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

        return back()->with('success', '修改密码成功');
    }
}
