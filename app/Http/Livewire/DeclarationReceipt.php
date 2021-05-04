<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Declaration;

class DeclarationReceipt extends Component
{
    public $declaration;

    public function mount(Declaration $declaration)
    {
        $this->declaration = $declaration;

        activity()
            ->useLog('declaration')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->declaration)
            ->log('opened details of declaration receipt');
    }
    

    public function render()
    {
        return view('livewire.declaration-receipt');
    }
}
