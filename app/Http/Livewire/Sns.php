<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Sns as SnsModel;
use Livewire\WithPagination;

class Sns extends Component
{
    use WithPagination;

    protected $listeners = [
        'save' => 'store',
//        'emitRefresh' => '$refresh',
    ];

    public $open = false;
    public $msg = '';

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
            $this->open = true;
            $this->msg = '机身SN重复！';
            return false;
        }

        if (SnsModel::where('chsn', $two)->first()) {
            $this->open = true;
            $this->msg = '彩盒SN重复！';
            return false;
        }

        SnsModel::create([
            'jssn' => $one,
            'chsn' => $two,
            'user_id' => Auth::id(),
        ]);

        $this->emit('emitRefresh');
    }

    public function render()
    {
        return view('livewire.sns', [
            'snss' => SnsModel::where('jssn', 'like', '%' . $this->search . '%')->orderByDesc('id')->paginate(20)
        ]);
    }
}
