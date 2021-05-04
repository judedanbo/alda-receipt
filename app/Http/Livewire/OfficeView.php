<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Livewire\Component;

class OfficeView extends Component
{
    public $office  ;
    public function mount($office)
    {
        // dd(Office::find($office));
        $this->office =  Office::findOrFail($office);

        activity()
            ->useLog('office')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->office)
            ->log('opened details of office');
    }
    public function render()
    {
        return view('livewire.office-view');
    }
}
