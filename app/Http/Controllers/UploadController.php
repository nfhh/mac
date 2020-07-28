<?php

namespace App\Http\Controllers;

use App\Mac;
use App\Pcba;
use App\Snkey;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function mac()
    {
        $macs = Mac::paginate();
        return view('upload.mac', compact('macs'));
    }

    public function handleMac(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        foreach ($excel_data as $key => $arr) {
            $data[$key] = [
                'mac' => $arr['360提供的MAC地址'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Mac::insert($data);
        return back()->with('success', '导入MAC表成功！');
    }

    public function snkey()
    {
        $snkeys = Snkey::paginate();
        return view('upload.snkey', compact('snkeys'));
    }

    public function handleSnkey(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        foreach ($excel_data as $key => $arr) {
            $data[$key] = [
                'sn' => $arr['360_SN，要求写在SP寄存器'],
                'key' => $arr['360_密钥,要求写在SS寄存器'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Snkey::insert($data);
        return back()->with('success', '导入SN&密钥表成功！');
    }

    public function pcba()
    {
        $pcbas = Pcba::paginate();
        return view('upload.pcba', compact('pcbas'));
    }

    public function handlePcba(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        // 重复 warning   不在 danger
        foreach ($excel_data as $k => $arr) {
            $sn = $arr['PCBA写入的SN，要求写在SP寄存器'];
            $data[$k]['sn'] = Snkey::where('sn', $sn)->count() === 0 ? '<span class="text-danger">' . $sn . '</span>' : $sn;
            $key = $arr['PCBA写入的密钥,要求写在SS寄存器'];
            $data[$k]['key'] = Snkey::where('key', $key)->count() === 0 ? '<span class="text-danger">' . $key . '</span>' : $key;
            $mac = $arr['PCBA写入的MAC地址'];
            $data[$k]['mac'] = Mac::where('mac', $arr['PCBA写入的MAC地址'])->count() === 0 ? '<span class="text-danger">' . $mac . '</span>' : $mac;

            $data[$k]['created_at'] = now();
            $data[$k]['updated_at'] = now();
        }

        $n = ["sn" => "text-warning", "key" => "text-primary", "mac" => "text-info"];
        $k = count($data);
        for ($i = 0; $i < $k; $i++) {
            for ($j = ($k - 1); $j > $i; $j--) {
                foreach ($data[$i] as $key => &$val) {
                    foreach ($data[$j] as $key1 => &$val1) {
                        if ($key == $key1 && $val == $val1) {
                            $val = '<span class="' . $n[$key] . '">' . $val . '</span>';
                            $val1 = '<span class="' . $n[$key] . '">' . $val1 . '</span>';
                        }
                    }
                }
            }
        }

        Pcba::insert($data);
        return back()->with('success', '导入PCBA结果表成功！');
    }
}
