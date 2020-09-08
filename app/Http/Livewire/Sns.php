<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Sns as SnsModel;
use Livewire\WithPagination;

class Sns extends Component
{
    use WithPagination;

    protected $listeners = [
        'save' => 'store',
    ];

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

    public function store($one, $two)
    {
        if (SnsModel::where('jssn', $one)->first()) {
            $this->emit('jssnx');
            return false;
        }

        if (SnsModel::where('chsn', $two)->first()) {
            $this->emit('chsnx');
            return false;
        }

        SnsModel::create([
            'jssn' => $one,
            'chsn' => $two,
        ]);

        $this->emit('resetFormOk');
    }

    public function render()
    {
        return view('livewire.sns', [
            'snss' => SnsModel::where('jssn', 'like', '%' . $this->search . '%')->orderByDesc('id')->paginate(20)
        ]);
    }
}
