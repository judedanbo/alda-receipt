<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Livewire\Component;
use Livewire\WithPagination;

class OfficeData extends Component
{
    use WithPagination;

    public $search = '' ;
    public $office = null ;

    public $sortField = 'office_name' ;
    public $sortDirection = 'asc' ;

    protected $queryString = ['sortField', 'sortDirection'];

    public $showDeleteModal = false;
    public $showFormModal = false;

    protected $rules = [
        'office.office_id' => 'required|integer|min:1|max:9999',
        'office.office_name' => 'required|regex:/^[a-zA-Z]/u|string|min:2|max:50',
    ];

    //  sort
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
    

    // Open create/edit office modal
    public function create($office = null)
    {
        // set current office if supplied in call
        if ($office !== null) {
            $this->office = Office::find($office);
        } else {
            $this->office = null;
        }
        $this->showFormModal = true;
    }

    // Save or update office
    public function save()
    {
        $validatedStaff = $this->validate()['office'];
        // redirect to update if current office is set
        if (isset($this->office->id)) {
            $this->update();
            return;
        }
        Office::create($validatedStaff);
        $this->office = null;
        $this->emit('office added');
        $this->showFormModal = false;
    }

    // update office
    public function update()
    {
        $this->office->save();
        $this->emit('office updated');
        $this->office = null;
        $this->showFormModal = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function deleteSelected()
    {
        $this->showDeleteModal = false;
        $officeName = $this->office->office_name;
        $this->office->delete();
        $this->office = null;

        $this->notify('You\'ve deleted '.$officeName.' transactions');
    }

    public function requestDelete($office = null)
    {
        if (isset($office)) {
            $this->office = Office::find($office);

            $this->showDeleteModal = true;
        }
    }

    public function show($office = null)
    {
        if ($office) {
            redirect()->route('office.show', ['office'=> $office]);
        }
    }


    public function render()
    {
        return view(
            'livewire.office-data',
            ['offices' => Office::search('office_id', $this->search)
            ->search('office_name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10)
            
            ]
        );
    }
}
