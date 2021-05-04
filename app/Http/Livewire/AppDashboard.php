<?php

namespace App\Http\Livewire;

use App\Models\Declaration;
use Livewire\Component;

class AppDashboard extends Component
{
    public $declaration;
    public $groupedByYear;
    public function mount()
    {
        $this->declaration = Declaration::all();
        // $this->groupedByYear = $this->declaration->groupBy(function ($item) {
        //     return substr($item['declared_on'], 0, 4);
        // });
        // dd($this->groupedByYear);

        activity()
            ->useLog('dashboard')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->log('dashboard opened');
    }
    public function render()
    {
        return view('livewire.app-dashboard');
    }
}
