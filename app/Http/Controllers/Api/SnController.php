<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Pcba;
use Illuminate\Http\Request;

class SnController extends Controller
{
    public function getSn(Request $request)
    {
        $pcba = Pcba::where('mac', $request->mac)->first();
        return response()->json([
            'code' => 0,
            'sn' => $pcba->sn,
        ]);
    }
}
