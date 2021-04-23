<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Declaration;

class DeclarationView extends Component
{
    public $declaration;

    public function mount($declaration)
    {
        $this->declaration = $declaration;
    }

    public function receipt()
    {
        redirect()->route('declaration.receipt', ['declaration' => $this->declaration]);
    }
    public function edit()
    {
        redirect()->route('declaration.form', ['declaration' => $this->declaration]);
    }    



    public function render()
    {
        return view('livewire.declaration-view', ['current_declaration' => Declaration::find($this->declaration)]);
    }
}
