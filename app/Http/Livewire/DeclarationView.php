<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Declaration;
use Illuminate\Support\Facades\Http;

class DeclarationView extends Component
{
    public $declaration;

    public function mount(Declaration $declaration)
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

    public function sync()
    {
        if ($this->declaration->synced == false) {
            $response  = Http::post('localhost:8880/api/declarations', $this->declaration->toArray());
            if ($response->body() == 'saved') {
                $this->declaration->synced = true;
                $this->declaration->save();
                $this->declaration->refresh;
                $this->notify('Declaration has been synchronized');
                return;
            }
            // dd($response->body());
        } else {
            $this->notify('Declaration has been synchronized');
        }
        $this->notify('Declaration failed synchronize');
    }



    public function render()
    {
        return view('livewire.declaration-view');
    }
}
