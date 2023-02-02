<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\AlertsTrait;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use AlertsTrait;

    public $user = null;
    public $role = [];
    public $isNew = true;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'role' => 'required',
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => User::query()
                ->select(['id', 'name', 'email'])
                ->with('roles:id,name')
                ->role(['administrador', 'vendedor'])
                ->paginate(10),
            'roles' => Role::where('name', '!=', 'root')->get(['id', 'name']),
        ]);
    }

    public function mount()
    {
        $this->user = new User();
    }

    public function store()
    {
        $this->validate();

        if ($isNew) {
            $this->user->setPassword();
        }

        $this->user->save();

        $this->user->syncRoles($this->role);

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
        $this->isNew = false;
        $this->user = $user;
        $this->role = $user->roles->pluck('name')->toArray();
        $this->emit('open-create-modal');
    }

    public function destroy(User $user)
    {
        $user->delete();
        $this->deleted();
    }
}
