<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\AlertsTrait;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class Users extends Component
{
    use AlertsTrait;

    public $user = null;
    public $role = [];
    public $isNew = true;

    public function rules()
    {
        return [
            'user.name' => ['required', 'max:100'],
            'user.email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'role' => 'required',
        ];
    }

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

        if ($this->isNew) {
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
