<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightRequest;
use App\Weight;

class WeightController extends Controller
{
    public function index()
    {
        return view('weight.index');
    }

    public function store(WeightRequest $request)
    {
        $data = $request->except('_token');
        if ($data['actual_val'] - $data['guess_val'] < $data['difference_val']) {
            $data['result'] = 'OK';
        } else {
            $data['result'] = 'NG';
        }
        Weight::create($data);
        return back()->with('success', '添加记录成功！');
    }
}
