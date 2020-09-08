<?php

namespace App\Http\Livewire;

use App\Snkey;
use App\Sn as SnModel;
use Livewire\Component;

class Sn extends Component
{
    protected $listeners = [
        'snRefresh' => '$refresh',
    ];

    public $sn;

    public $search = '';
    public $page = 1;

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
            $this->addError('sn', 'sn校验失败！');
            return false;
        }

        $this->resetErrorBag('sn');
        $sn_row = SnModel::where('sn', $val)->first();

        if ($sn_row) {
            $this->addError('sn', '该sn已校验入库！');
            return false;
        }

        $sn_obj = SnModel::create([
            'sn' => $val
        ]);

        $this->sn = '';

        $this->emitSelf('snRefresh');
    }

    public function render()
    {
        return view('livewire.sn', [
            'sns' => SnModel::where('sn', 'like', '%' . $this->search . '%')->paginate(20)
        ]);
    }
}
