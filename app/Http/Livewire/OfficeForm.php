<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Livewire\Component;

class OfficeForm extends Component
{
    public $office;

    protected $rules = [
        'office.office_id' => 'required|string|min:1|max:3',
        'office.office_name' => 'required|regex:/^[a-zA-Z]/u|string|min:2|max:50',
    ];
    
    public function mount($office = null)
    {
        if ($office) {
            $this->office = Office::findOrFail($office);
        }

        activity()
            ->useLog('office')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->log('opened create/edit office form');
    }

    public function save()
    {
        $validated = $this->validate()['office'];

        if (isset($this->office->id)) {
            $this->update();
            return;
        }
        
        $newOffice = Office::create($validated);
        $this->office = false;
        $this->emit('office_added');

        redirect()->route('office.show', ['office' => $newOffice->id]);
    }

    public function update()
    {
        $this->office->save();
    }

    public function render()
    {
        return view('livewire.office-form');
    }
}
