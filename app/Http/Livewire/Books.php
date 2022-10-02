<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Books extends Component
{
    public $table = "incomes";
    public $start, $end, $search_category, $owner;

    public function mount()
    {
        $this->start = date('Y-m-d');
        $this->end = date('Y-m-d');
    }

    public function render()
    {
        $entries = DB::table($this->table)
            ->whereBetween('created_at', [$this->start, $this->end])
            ->when($this->search_category, function($q) {
                $q->where('category', $this->search_category);
            })
            ->when($this->owner, function($q) {
                $q->where('owner', $this->owner);
            })
            ->get(['created_at', 'description', 'total_value']);

        return view('livewire.books', compact('entries'));
    }
}
