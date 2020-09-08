<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Weight as WeightModel;

class Weight extends Component
{
    protected $listeners = [
        'getWeight'
    ];
    public $machine;
    public $sn;
    public $guess_val;
    public $difference_val;
    public $actual_val;

    public $search = '';
    public $page = 1;

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'page'));
        $weight = WeightModel::orderByDesc('id')->first();
        $this->machine = $weight->machine;
        $this->guess_val = $weight->guess_val;
        $this->difference_val = $weight->difference_val;
    }

    public function getWeight($val)
    {
        $this->actual_val = $val;
    }

    public function store()
    {
        $validated_data = $this->validate([
            'machine' => 'required',
            'sn' => 'required|unique:weights,sn',
            'guess_val' => 'required',
            'difference_val' => 'required',
            'actual_val' => 'required',
        ]);

        if (abs($validated_data['actual_val'] - $validated_data['guess_val']) < $validated_data['difference_val']) {
            $validated_data['result'] = 'OK';
        } else {
            $validated_data['result'] = 'NG';
        }
        WeightModel::create($validated_data);
        $this->machine = '';
        $this->sn = '';
        $this->guess_val = '';
        $this->difference_val = '';
        $this->actual_val = '';
        $this->dispatchBrowserEvent('refocus');
    }

    public function render()
    {
        return view('livewire.weight', [
            'weights' => WeightModel::where('sn', 'like', '%' . $this->search . '%')->paginate(20)
        ]);
    }
}
