<?php

namespace App\Http\Livewire;

use App\Models\Decoration;
use App\Models\Forniture;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;

class DecorationsRegister extends Component
{
    use PaginationTrait;
    use AlertsTrait;

    public $decoration;
    public $materials = [];
    public $total = 0;

    protected $rules = [
        'decoration.description' => 'nullable|max:100',
        'decoration.manpower' => 'required|numeric',
        'decoration.extra' => 'nullable|numeric',
        'materials' => 'required|array'
    ];

    //sumar todos los precios de los materiales
    public function updatedMaterials()
    {
        // $this->total = 0;
        // foreach ($this->materials as $material) {
        //     $this->total += Forniture::find($material)->price;
        // }
    }

    public function render()
    {
        return view('livewire.decorations-register', [
            'fornitures' => Forniture::all(['id', 'name', 'price']),
        ]);
    }

    public function mount($decoration = null)
    {
        if ($decoration) {
            $this->decoration = Decoration::with('fornitures')->find($decoration);
            $this->materials = $this->decoration->fornitures->pluck('id')->toArray();
        } else {
            $this->createDecorationInstance();
        }
    }

    public function store()
    {
        $this->validate();
        $this->decoration->save();

        $this->decoration->fornitures()->sync($this->materials);

        $this->created();
        $this->resetInputFields();
        return redirect()->route('decorations');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->createDecorationInstance();
    }

    public function createDecorationInstance()
    {
        $this->decoration = new Decoration();
        $this->decoration->status = true;
    }
}
