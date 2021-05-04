<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Livewire\Component;

class StaffForm extends Component
{
    public $staff;
    

    public function mount($staff = null)
    {
        if ($staff) {
            // dd($staff);
            $this->staff = Staff::findOrFail($staff);
        }
        activity()
            ->useLog('staff')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->log('create new staff form opened');
    }

    protected $rules = [
        "staff.staff_id" => "required|integer|min:1|max:99999999",
        "staff.title" => "string|regex:/^[a-zA-Z]/u|min:2|max:10|nullable",
        "staff.email" => "required|string|email|max:255",
        "staff.surname" => "required|string|regex:/^[a-zA-Z]/u|min:2|max:100",
        "staff.other_names" => "required|string|regex:/^[a-zA-Z]/u|min:2|max:100",
    ];

    public function save()
    {
        $validatedStaff = $this->validate()['staff'];

        if (isset($this->staff->id)) {
            $this->update();
            return;
        }
        $newStaff = Staff::create($validatedStaff);
        $this->staff = false;
        $this->emit('staff_added');

        redirect()->route('staff.show', ['staff' =>$newStaff->id]);
    }

    public function update()
    {
        $this->staff->save();
    }

    public function render()
    {
        return view('livewire.staff-form');
    }
}
