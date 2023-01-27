<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\AlertsTrait;
use Livewire\Component;

class Users extends Component
{
    use AlertsTrait;

    public $user = null;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.password' => 'required|min:8',
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => User::select(['id', 'name', 'email'])->paginate(10)
        ]);
    }

    public function mount()
    {
        $this->user = new User();
    }

    public function store()
    {
        $this->validate();

        $this->user->hashPassword();
        $this->user->save();

        $this->resetInputFields();
        $this->created();
        $this->emit('close-create-modal');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->user = new User();
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->emit('open-create-modal');
    }

    public function destroy(User $user)
    {
        $user->delete();
        $this->deleted();
    }
}
