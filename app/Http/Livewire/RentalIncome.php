<?php

namespace App\Http\Livewire;

use App\Models\Rent;
use App\Services\CurrencyService;
use App\Traits\AlertsTrait;
use App\Traits\PropertiesTrait;
use Livewire\Component;

class RentalIncome extends Component
{
    use PropertiesTrait;
    use AlertsTrait;

    public $startDate = null;
    public $endDate = null;

    public function render()
    {
        $rents = Rent::filterDate($this->startDate, $this->endDate)->get();

        return view('livewire.rental-income', [
            'rents' => $rents,
            'total' => (new CurrencyService)->format($rents->sum('total'))
        ]);
    }

    public function mount()
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function destroy($id)
    {
        Rent::where('id', $id)->delete();
        $this->deleted();
    }
}
