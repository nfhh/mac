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
        $macs = Mac::paginate(20);
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
        $snkeys = Snkey::paginate(20);
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
        $pcbas = Pcba::paginate(20);
        return view('upload.pcba', compact('pcbas'));
    }

    public function handlePcba(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        // 重复 warning   不在 danger
        $b = 0;
        foreach ($excel_data as $k => $arr) {
            $sn = $arr['PCBA写入的SN，要求写在SP寄存器'];
            if (Snkey::where('sn', $sn)->count() === 0) {
                $b++;
                $data[$k]['sn'] = '<span class="text-danger">' . $sn . '</span>';
            } else {
                $data[$k]['sn'] = $sn;
            }

            $key = $arr['PCBA写入的密钥,要求写在SS寄存器'];
            if (Snkey::where('key', $key)->count() === 0) {
                $b++;
                $data[$k]['key'] = '<span class="text-danger">' . $key . '</span>';
            } else {
                $data[$k]['key'] = $key;
            }

            $mac = $arr['PCBA写入的MAC地址'];
            if (Mac::where('mac', $arr['PCBA写入的MAC地址'])->count() === 0) {
                $b++;
                $data[$k]['mac'] = '<span class="text-danger">' . $mac . '</span>';
            } else {
                $data[$k]['mac'] = $mac;
            }

            $data[$k]['created_at'] = now();
            $data[$k]['updated_at'] = now();
        }

        $n = ["sn" => "text-warning", "key" => "text-primary", "mac" => "text-info"];
        $k = count($data);
        $c = 0;
        for ($i = 0; $i < $k; $i++) {
            for ($j = ($k - 1); $j > $i; $j--) {
                foreach ($data[$i] as $key => &$val) {
                    foreach ($data[$j] as $key1 => &$val1) {
                        if ($key == $key1 && $val == $val1) {
                            $c++;
                            if (strpos($val, $n[$key]) === false) {
                                $val = '<span class="' . $n[$key] . '">' . $val . '</span>';
                                $val1 = '<span class="' . $n[$key] . '">' . $val1 . '</span>';
                            }
                        }
                    }
                }
            }
        }

        Pcba::insert($data);

        $str = '导入PCBA结果表成功！';

        if ($b && $c) {
            $str .= '<br/>多余：<strong class="text-danger">' . $b . '</strong>处，重复：<strong class="text-danger">' . $c . '</strong>处';
        } elseif ($b) {
            $str .= '<br/>多余：<strong class="text-danger">' . $b . '</strong>处';
        } elseif ($c) {
            $str .= '<br/>重复：<strong class="text-danger">' . $c . '</strong>处';
        }
        return back()->with('success', $str);
    }
}
