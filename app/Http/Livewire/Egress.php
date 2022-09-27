<?php

namespace App\Http\Livewire;

use App\Models\Egress as ModelsEgress;
use Livewire\Component;

class Egress extends Component
{
    public function render()
    {
        $egress = ModelsEgress::paginate(20);
        return view('livewire.egress', compact('egress'));
    }
}
