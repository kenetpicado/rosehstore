<?php

namespace App\Http\Livewire;

use App\Models\Forniture;
use App\Models\Rent;
use App\Traits\AlertsTrait;
use Livewire\Component;

class Fornitures extends Component
{
    use AlertsTrait;

    public $forniture;
    public $search = null;
    public $rent = null;

    public $rent_quantity = 1;
    public $rent_price = 0;
    public $rent_description = '';
    public $forniture_id = null;

    protected $rules = [
        'forniture.name' => 'required|max:100',
        'forniture.price' => 'required|numeric',
        'forniture.image' => 'required|url|max:255',
        'forniture.status' => 'required',
    ];

    public function render()
    {
        return view('livewire.fornitures', [
            'fornitures' => Forniture::orderBy('name')
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(20)
        ]);
    }

    public function store()
    {
        $this->validate();
        $this->forniture->save();

        $this->resetInputFields();
        $this->created();
        $this->emit('close-create-modal');
    }

    public function mount()
    {
        $this->forniture = new Forniture();
        $this->forniture->status = true;
    }

    public function showRentModal(Forniture $forniture)
    {
        $this->forniture_id = $forniture->id;
        $this->rent_quantity = 1;
        $this->rent_price = $forniture->price;
        $this->emit('open-rent-modal');
    }

    public function storeRent()
    {
        $data = $this->validate([
            'rent_quantity' => 'required|numeric|min:1',
            'rent_price' => 'required|numeric|min:0',
            'rent_description' => 'nullable|max:100',
        ]);

        Rent::create([
            'description' => $this->rent_description,
            'quantity' => $this->rent_quantity,
            'price' => $this->rent_price,
            'forniture_id' => $this->forniture_id,
            'created_at' => now()->format('Y-m-d')
        ]);

        $this->resetInputFields();
        $this->created();
        $this->emit('close-rent-modal');
    }

    public function edit(Forniture $forniture)
    {
        $this->forniture = $forniture;
        $this->emit('open-create-modal');
    }

    public function destroy($forniture)
    {
        if (Rent::where('forniture_id', $forniture)->exists()) {
            $this->hasError("No se puede eliminar el articulo porque tiene rentas asociadas.");
            return;
        }

        Forniture::where('id', $forniture)->delete();
        $this->deleted();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
    }
}
