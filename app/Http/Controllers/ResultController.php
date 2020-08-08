<?php

namespace App\Http\Controllers;

use App\result;

class ResultController extends Controller
{

    public function index()
    {
        $results = Result::paginate(20);
        return view('result.index', compact('results'));
    }
}
