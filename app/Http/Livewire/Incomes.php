<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;

class Incomes extends Component
{
    public function render()
    {
        $incomes = Income::paginate(20);
        return view('livewire.incomes', compact('incomes'));
    }
}
