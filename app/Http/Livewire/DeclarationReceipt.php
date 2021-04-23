<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Declaration;

class DeclarationReceipt extends Component
{
    public $declaration;

    public function mount(Declaration $declaration){
        $this->declaration = $declaration;
    }

    public function render()
    {
        return view('livewire.declaration-receipt');
    }
}
