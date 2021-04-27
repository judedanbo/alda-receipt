<?php

namespace App\Http\Livewire;

use App\Models\Declaration;
use Livewire\Component;


class SyncDeclarations extends Component
{

    public function render()
    {
        return view('livewire.sync-declarations',
        [
            'declaration' => Declaration::all(),
        ]);
    }
}
