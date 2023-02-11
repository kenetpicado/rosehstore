<?php

namespace App\Http\Livewire;

use App\Models\Decoration;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Decorations extends Component
{
    use PaginationTrait;

    public function render()
    {
        return view('livewire.decorations', [
            'decorations' => Decoration::paginate()
        ]);
    }
}
