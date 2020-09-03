<?php

namespace App\Http\Controllers;

use App\Mac;
use App\Pcba;
use App\Result;
use App\Snkey;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function mac()
    {
        $macs = Mac::filter()->paginate(20);
        return view('upload.mac', compact('macs'));
    }

    public function handleMac(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        foreach ($excel_data as $key => $arr) {
            $mac = $arr['360提供的MAC地址'];
            if (strlen($mac) !== 12) {
                return back()->withErrors($key . '行的mac不合法！');
            }
            $data[$key] = [
                'mac' => $mac,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Mac::insert($data);
        return back()->with('success', '导入MAC表成功！');
    }

    public function snkey()
    {
        $snkeys = Snkey::filter()->paginate(20);
        return view('upload.snkey', compact('snkeys'));
    }

    public function handleSnkey(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        foreach ($excel_data as $key => $arr) {
            $sn = $arr['360_SN，要求写在SP寄存器'];
            $keyx = $arr['360_密钥,要求写在SS寄存器'];
            if (strlen($sn) !== 18) {
                return back()->withErrors($key . '行的sn不合法！');
            }
            if (strlen($keyx) !== 32) {
                return back()->withErrors($key . '行的密钥不合法！');
            }
            $data[$key] = [
                'sn' => $sn,
                'key' => $keyx,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Snkey::insert($data);
        return back()->with('success', '导入SN&密钥表成功！');
    }

    public function pcba()
    {
        $pcbas = Pcba::filter()->paginate(20);
        return view('upload.pcba', compact('pcbas'));
    }

    public function handlePcba(Request $request)
    {
        $excel_data = readExcel($request->file('file'));
        $data = [];
        // 重复 text-primary   不在 text-danger
        $b = 0;
        $result = [];
        foreach ($excel_data as $k => $arr) {
            $sn = $arr['PCBA写入的SN，要求写在SP寄存器'];
            $data[$k]['sn'] = $sn;
            if (Snkey::where('sn', $sn)->count() === 0) {
                $b++;
                $result[$k + 1]['sn'] = '<span class="text-danger">' . $sn . '</span>';
            }
            $key = $arr['PCBA写入的密钥,要求写在SS寄存器'];
            $data[$k]['key'] = $key;
            if (Snkey::where('key', $key)->count() === 0) {
                $b++;
                $result[$k + 1]['key'] = '<span class="text-danger">' . $key . '</span>';
            }

            $mac = $arr['PCBA写入的MAC地址'];
            $data[$k]['mac'] = $mac;
            if (Mac::where('mac', $mac)->count() === 0) {
                $b++;
                $result[$k + 1]['mac'] = '<span class="text-danger">' . $mac . '</span>';
            }
            $data[$k]['created_at'] = now();
            $data[$k]['updated_at'] = now();
        }

        $k = count($data);
        $c = 0;

        for ($i = 0; $i < $k; $i++) {
            for ($j = ($k - 1); $j > $i; $j--) {
                foreach ($data[$i] as $ind => $val) {
                    foreach ($data[$j] as $ind1 => $val1) {
                        if ($ind == $ind1 && $val == $val1) {
                            $c++;
                            $result[$k][$ind1] = '<span class="text-primary">' . $val1 . '</span>';
                        }
                    }
                }
            }
        }

        Pcba::insert($data);

        foreach ($result as $id => &$arr) {
            $arr['id'] = $id;
            $arr['created_at'] = now();
            $arr['updated_at'] = now();
        }
        Result::insert($result);

        $str = '导入PCBA结果表成功！';
        if ($b && $c) {
            $str .= '<br/>多余：<strong class="text-danger">' . $b . '</strong>处，重复：<strong class="text-primary">' . $c . '</strong>处';
        } elseif ($b) {
            $str .= '<br/>多余：<strong class="text-danger">' . $b . '</strong>处';
        } elseif ($c) {
            $str .= '<br/>重复：<strong class="text-primary">' . $c . '</strong>处';
        }
        return back()->with('success', $str);
    }
}
