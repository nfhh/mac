<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Mac;
use App\Pcba;
use App\Snkey;
use Illuminate\Http\Request;

class SnController extends Controller
{
    public function getSn(Request $request)
    {
        $pcba = Pcba::where('mac', $request->mac)->get(); // 找到多个说明mac有重复 但找到一个不一定正确 有可能是多出的

        $c = $pcba->count();
        if ($c === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'mac不存在！',
            ]);
        }
        if ($c > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'mac重复！',
            ]);
        }
        $mac = Mac::where('mac', $pcba->mac)->first();
        if (is_null($mac)) {
            return response()->json([
                'code' => -1,
                'message' => 'mac是多余的！',
            ]);
        }

        $sn = Snkey::where('sn', $pcba->sn)->get();
        $s = $sn->count();
        if ($s === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'sn不存在！',
            ]);
        }
        if ($s > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'sn重复！',
            ]);
        }

        $sn2 = Snkey::where('key', $pcba->key)->get();
        $s2 = $sn2->count();
        if ($s2 === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'key不存在！',
            ]);
        }
        if ($s2 > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'key重复！',
            ]);
        }

        return response()->json([
            'code' => 0,
            'message' => '',
            'data' => $pcba,
        ]);
    }
}
