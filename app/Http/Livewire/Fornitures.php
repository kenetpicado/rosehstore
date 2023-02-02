<?php

namespace App\Http\Livewire;

use App\Models\Forniture;
use App\Traits\AlertsTrait;
use Livewire\Component;

class Fornitures extends Component
{
    use AlertsTrait;

    public $forniture;

    protected $rules = [
        'forniture.name' => 'required|max:100',
        'forniture.description' => 'required|max:50',
        'forniture.cost' => 'required|numeric',
        'forniture.quantity' => 'required|numeric',
        'forniture.price' => 'required|numeric',
        'forniture.image' => 'nullable|url|max:255',
        'forniture.status' => 'required',
    ];

    public function render()
    {
        return view('livewire.fornitures', [
            'fornitures' => Forniture::orderByDesc('status')->paginate(20)
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

    public function edit(Forniture $forniture)
    {
        $this->forniture = $forniture;
        $this->emit('open-create-modal');
    }

    public function destroy(Forniture $forniture)
    {
        $forniture->delete();
        $this->deleted();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
    }
}
