<?php

namespace App\Http\Livewire;

use App\Snkey;
use App\Sn as SnModel;
use Livewire\Component;
use Livewire\WithPagination;

class Sn extends Component
{
    use WithPagination;

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
            $this->emit('snx1');
            return false;
        }

        $sn_row = SnModel::where('sn', $val)->first();

        if ($sn_row) {
            $this->emit('snx2');
            return false;
        }

        $this->sn = '';

        $sn_obj = SnModel::create([
            'sn' => $val
        ]);
    }

    public function render()
    {
        return view('livewire.sn', [
            'sns' => SnModel::where('sn', 'like', '%' . $this->search . '%')->orderByDesc('id')->paginate(20)
        ]);
    }
}
