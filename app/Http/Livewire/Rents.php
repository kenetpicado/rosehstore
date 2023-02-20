<?php

namespace App\Http\Livewire;

use App\Models\Forniture;
use App\Models\Rent;
use App\Traits\AlertsTrait;
use Livewire\Component;

class Rents extends Component
{
    use AlertsTrait;

    public $forniture = null;
    public $rent = null;

    protected $rules = [
        'rent.description' => 'nullable|string|max:100',
        'rent.quantity' => 'required|integer|min:1',
        'rent.price' => 'required|numeric|min:0',
        'rent.forniture_id' => 'required|integer',
    ];

    public function render()
    {
        return view('livewire.rents', [
            'rents' => Rent::getByForniture($this->forniture->id)
        ]);
    }

    public function mount($forniture)
    {
        $this->forniture = Forniture::find($forniture);
        $this->createRentInstance();
    }

    public function store()
    {
        $this->validate();
        $this->rent->setDate();
        $this->rent->save();

        $this->emit('close-create-modal');
        $this->created();
        $this->resetInputFields();
    }

    public function edit(Rent $rent)
    {
        $this->rent = $rent;
        $this->emit('open-create-modal');
        $this->emit('update-price-rent');
    }

    public function resetInputFields()
    {
        $this->resetExcept(['forniture']);
        $this->resetErrorBag();
        $this->createRentInstance();
    }

    public function destroy($id)
    {
        Rent::where('id', $id)->delete();
        $this->deleted();
    }

    public function createRentInstance()
    {
        $this->rent = new Rent();
        $this->rent->forniture_id = $this->forniture->id;
        $this->rent->quantity = 1;
        $this->rent->price = $this->forniture->price;
    }
}
