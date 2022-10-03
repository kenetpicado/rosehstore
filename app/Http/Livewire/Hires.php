<?php

namespace App\Http\Livewire;

use App\Models\Egress;
use App\Models\Hire;
use App\Models\Income;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Hires extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $description, $total_value, $created_at, $client = "";

    public function resetInputFields()
    {
        $this->reset();
    }

    public function mount()
    {
        $this->created_at = date('Y-m-d');
    }

    protected $rules = [
        'description' => 'required|max:100',
        'client' => 'required|max:50',
        'total_value' => 'required|numeric',
        'created_at' => 'required|date',
    ];

    public function render()
    {
        $hires = DB::table('hires')->latest('id')->paginate(20);
        return view('livewire.hires', compact('hires'));
    }

    public function store()
    {
        $data = $this->validate();

        Hire::create($data);

        Income::create([
            'description' => $this->description,
            'amount' =>  1,
            'value' =>  $this->total_value,
            'total_value' => $this->total_value,
            'category' => 'MOBILIARIO',
            'client' =>  $this->client,
            'discount' => 0,
            'owner' => '-',
            'created_at' =>  $this->created_at,
        ]);

        session()->flash('message', 'Guardado');
        $this->reset();
        $this->emit('closeModal');
    }
}
