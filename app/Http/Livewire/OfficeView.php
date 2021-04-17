<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Livewire\Component;

class OfficeView extends Component
{
    public $office  ;
    public function mount($office)
    {
        $this->office =  Office::findOrFail($office);
    }
    public function render()
    {
        return view('livewire.office-view');
    }
}
