<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Declaration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class DeclarationForm extends Component
{
    public $declaration ;

    protected $rules = [
        'declaration.declared_on' => 'required|date|before_or_equal:today',
        'declaration.declarant_name' => 'required|string|max:250|min:2',
        'declaration.post' => 'required|string|max:200|min:2',
        'declaration.schedule' => 'string|max:200|min:2|nullable',
        'declaration.office_location' => 'string|max:200|min:2|nullable',
        'declaration.address' => 'required|string|max:255|min:2',
        'declaration.contact' => 'string|max:50|min:2|nullable',
        'declaration.witness' => 'required|string|max:250|min:2',
        'declaration.witness_occupation' => 'string|max:250|min:2|nullable',
        'declaration.person_submitting' => 'required|string|max:250|min:2',
        'declaration.person_submitting_contact' => 'string|max:250|min:2|nullable',
        // 'user_id' => 'requ',
    ];

    protected $messages = [
        // 'declaration.declared_on.before_or_equal' => 'The date of declaraion must '
    ];

    protected $validationAttributes = [
        'declaration.declared_on' => 'date of declaration',
        'declaration.declarant_name' => 'declarant name',
        'declaration.post' => 'post',
        'declaration.schedule' => 'schedule',
        'declaration.office_location' => 'office location',
        'declaration.address' => 'address',
        'declaration.contact' => 'contact',
        'declaration.witness' => 'witness',
        'declaration.witness_occupation' => 'witness occupation',
        'declaration.person_submitting' => 'person submitting',
        'declaration.person_submitting_contact' => 'contact of person submitting',
    ];

    public function save()
    {
        $validatedStaff = $this->validate()['declaration'];

        if (isset($this->declaration->id)) {
            $this->update();
            return;
        }
        if(Auth::user()->has('staff')){
            if(Auth::user()->staff){
                dd(Auth::user()->staff->current_office);
                $office_id = Auth::user()->staff->current_office->office_id;
            }
            else{
                $office_id = 'X0' ;
            }
        }

        $total = DB::table('declarations')->count();

        $validatedStaff['user_id'] = Auth::id();
        $validatedStaff['qrcode'] = Str::random(15);
        $validatedStaff['receipt_no'] = $office_id . Str::padLeft($total + 1, 5, '0');

        $newDeclaration = Declaration::create($validatedStaff);
        $this->declaration = null;
        $this->emit('New Declaration added');
        $this->showFormModal = false;
        redirect()->route('declaration.show', ['declaration'=> $newDeclaration->id]);
    }

    public function update()
    {
        $this->declaration->save();
        $this->emit('Declaration of '. $this->declaration->declarant_name . ' updated');
        $this->declaration = null;
        $this->showFormModal = false;
        redirect()->route('declaration.show', ['declaration'=> $this->declaration->id]);
    }

    public function updated($propertyName)
    {
        // dd($this->declaration);
        $this->validateOnly($propertyName);

    }

    public function mount($declaration = null)
    {
        // dd($declaration);
        if($declaration !== null){
            $this->declaration = Declaration::find($declaration);
        }
        
    }

    public function render()
    {
        return view('livewire.declaration-form');
    }
}
