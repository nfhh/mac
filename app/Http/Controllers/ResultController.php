<?php

namespace App\Http\Controllers;

use App\Result;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::paginate(20);
        return view('result.index', compact('results'));
    }

    public function truncate()
    {
        \App\Result::truncate();
        return back()->with('success', '清空对比结果成功！');
    }
}
