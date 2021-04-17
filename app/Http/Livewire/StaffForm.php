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
    }

    protected $rules = [
        "staff.staff_id" => "required|string|min:2|max:10",
        "staff.title" => "string|regex:/^[a-zA-Z]/u|min:2|max:10|nullable",
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
        Staff::create($validatedStaff);
        $this->staff = false;
        $this->emit('staff_added');
    }

    public function update()
    {
        $this->staff->save();
    }

    public function render()
    {
        return view('livewire.staff-form')->layout('layouts.guest');
    }
}
