<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class StaffData extends Component
{
    use WithPagination;

    protected $queryString = ['sortField', 'sortDirection'];

    public $search = '';

    public $staff;
    
    public $showDeleteModal = false;
    public $showFormModal = false;
    public $showFilters = false;
    public $filters = [
        'search' =>'',
        'title' => '',
        'surname' => '',
        'other_names' => null,
    ];

    protected $rules = [
        "staff.staff_id" => "required|integer|min:1|max:99999999",
        "staff.title" => "string|regex:/^[a-zA-Z]/u|min:2|max:10|nullable",
        "staff.email" => "required|string|email|max:255",
        "staff.surname" => "required|string|regex:/^[a-zA-Z]/u|min:2|max:100",
        "staff.other_names" => "required|string|regex:/^[a-zA-Z]/u|min:2|max:100",
    ];

    public $sortField ='staff_id';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->staff = null;
    }
    public function save()
    {
        $validatedStaff = $this->validate()['staff'];

        if (isset($this->staff->id)) {
            $this->update();
            return;
        }
        Staff::create($validatedStaff);
        $this->staff = null;
        $this->emit('staff added');
        $this->showFormModal = false;
    }

    public function update()
    {
        $this->staff->save();
        $this->emit('staff updated');
        $this->staff = null;
        $this->showFormModal = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            ;
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function create($staff = null)
    {
        if ($staff !== null) {
            $this->staff = Staff::find($staff);
        } else {
            $this->staff = null;
        }
        $this->showFormModal = true;
    }

    public function deleteSelected()
    {
        $this->showDeleteModal = false;
        $staffName = $this->staff->full_name;
        $this->staff->delete();
        $this->staff = null;


        $this->notify('You\'ve deleted '.$staffName.' transactions');
    }

    public function requestDelete($staff = null)
    {
        if (isset($staff)) {
            $this->staff = Staff::find($staff);

            $this->showDeleteModal = true;
        }
    }

    public function show($staff = null)
    {
        if ($staff) {
            redirect()->route('staff.show', ['staff'=> $staff]);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view(
            'livewire.staff-data',
            ['allStaff' =>Staff::search('surname', $this->search)
                ->search('staff_id', $this->search)
                ->search('title', $this->search)
                ->search('other_names', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15)
            ]
        );
    }
}
