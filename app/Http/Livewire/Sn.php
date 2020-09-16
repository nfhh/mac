<?php

namespace App\Http\Livewire;

use App\Snkey;
use App\Sn as SnModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Sn extends Component
{
    use WithPagination;

    public $sn;

    public $search = '';
    public $page = 1;

    public $msg = '';

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'page'));
    }

    public function updatedSn($val)
    {
        $row = Snkey::where('sn', $val)->first();
        if (is_null($row)) {
            $this->addError('sn', 'SN不存在！');
            return false;
        }

        $sn_row = SnModel::where('sn', $val)->first();

        if ($sn_row) {
            $this->addError('sn', 'SN已存在！');
            return false;
        }

        $this->sn = '';

        $sn_obj = SnModel::create([
            'sn' => $val,
            'user_id' => Auth::id(),
        ]);
    }

    public function render()
    {
        return view('livewire.sn', [
            'sns' => SnModel::with('user')->where('sn', 'like', '%' . $this->search . '%')->orderByDesc('id')->paginate(20)
        ]);
    }
}
