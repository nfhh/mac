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
        $r_mac = strtoupper(str_replace(':', '', $request->mac));
        $pcba = Pcba::where('mac', $r_mac)->get(); // 找到多个说明mac有重复 但找到一个不一定正确 有可能是多出的

        $c = $pcba->count();
        if ($c === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'mac:' . $r_mac . '不存在！',
            ]);
        }
        if ($c > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'mac:' . $r_mac . '重复！',
            ]);
        }

        $mac = Mac::where('mac', $r_mac)->first();
        if (is_null($mac)) {
            return response()->json([
                'code' => -1,
                'message' => 'mac:' . $mac . '是多余的！',
            ]);
        }

        $sn = Snkey::where('sn', $pcba->first()->sn)->get();
        $s = $sn->count();
        if ($s === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'sn:' . $sn . '不存在！',
            ]);
        }
        if ($s > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'sn:' . $sn . '重复！',
            ]);
        }

        $key = Snkey::where('key', $pcba->first()->key)->get();
        $s2 = $key->count();
        if ($s2 === 0) {
            return response()->json([
                'code' => -1,
                'message' => 'key:' . $key . '不存在！',
            ]);
        }
        if ($s2 > 1) {
            return response()->json([
                'code' => -1,
                'message' => 'key:' . $key . '重复！',
            ]);
        }

        return response()->json([
            'code' => 0,
            'message' => '',
            'data' => $pcba->first(),
        ]);
    }
}
