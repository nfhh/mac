<?php

namespace App\Http\Livewire;

use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Weight as WeightModel;
use Livewire\WithPagination;

class Weight extends Component
{
    use WithPagination;

    protected $listeners = [
        'getWeight'
    ];

    public $products = [];

    public $form = [
        'machine' => '',
        'sn' => '',
        'guess_val' => '',
        'difference_val' => '',
        'actual_val' => '',
    ];

    public $users = [];
    public $search = [
        'sn' => '',
        'created_at' => '', // "2020-09-15"
        'user_id' => '',
    ];

    public $open = false;

    public function mount()
    {
        $this->users = User::all();
        $this->products = Product::all();
        $product = Product::first();
        if ($product) {
            $this->form['machine'] = $product->title;
            $this->form['guess_val'] = $product->guess_val;
            $this->form['difference_val'] = $product->difference_val;
        }
    }

    public function updated($name, $value)
    {
        if ($name === 'form.machine') {
            $product = Product::findOneByTitle($value);
            $this->form['guess_val'] = $product->guess_val;
            $this->form['difference_val'] = $product->difference_val;
        }
    }


    public function getWeight($val)
    {
        $this->form['actual_val'] = $val;
    }

    public function handleStore()
    {
        if ($this->form['actual_val'] === '') {
            return false;
        }

        if (WeightModel::findOneBySn($this->form['sn'])) {
            $this->open = true;
            return false;
        }

        $this->store();

        $this->resetForm();

        $this->dispatchBrowserEvent('refocus');
    }

    public function handleUpdate()
    {
        WeightModel::findOneBySn($this->form['sn'])->delete();
        $this->open = false;
        $this->store();
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->form['sn'] = '';
        $this->form['actual_val'] = '';
    }

    private function store()
    {
        if (abs($this->form['actual_val'] - $this->form['guess_val']) < $this->form['difference_val']) {
            $this->form['result'] = 'OK';
        } else {
            $this->form['result'] = 'NG';
        }

        $this->form['user_id'] = Auth::id();

        return WeightModel::create($this->form);
    }

    public function render()
    {
        return view('livewire.weight', [
            'weights' => WeightModel::filter($this->search)->orderByDesc('created_at')->paginate(20),
            'count' => WeightModel::filter($this->search)->count('id'),
        ]);
    }
}
