<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Declaration;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class DeclarationData extends Component
{
    use WithPagination;
    public $declaration;
    public $declaration_id;
    public $search;

    public $sortField = 'declared_on' ;
    public $sortDirection = 'desc' ;

    public $showFormModal = false;

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


    public function show($declaration = null)
    {
        if ($declaration) {
            redirect()->route('declaration.show', ['declaration'=> $declaration]);
        }
    }

    // Open create/edit Declaration modal
    public function create($declaration = null)
    {
        // set current $declaration if supplied in call
        if ($declaration !== null) {
            $this->$declaration = $declaration::find($declaration);
        } else {
            $this->$declaration = null;
        }
        $this->showFormModal = true;
    }



    public function save()
    {
        $validatedStaff = $this->validate()['declaration'];

        if (isset($this->declaration->id)) {
            $this->update();
            return;
        }

        if (Auth::user()->staff) {
            dd(Auth::user()->staff->current_office);
            $office_id = Auth::user()->staff->current_office->office_id;
        } else {
            $office_id = 'X0' ;
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
        $this->showFormModal = false;
        redirect()->route('declaration.show', ['declaration'=> $this->declaration->id]);
        $this->declaration = null;
    }

    public function updated($propertyName)
    {
        // dd($this->declaration);
        $this->validateOnly($propertyName);
    }
    public function expandForm()
    {
        if (isset($this->declaration->id)) {
            redirect()->route('declaration.form', ['declaration' =>$this->declaration->id]);
            return;
        }
        // dd($this->declaration);
        redirect()->route('declaration.form');
    }

    public function syncOne($syncedToDeclaration)
    {
        $toSync =  Declaration::with('enteredBy.staff')->find($syncedToDeclaration);
        $response = Http::post('localhost:8880/api/declarations', $toSync->toArray());
        if ($response->body() == 'saved') {
            $toSync->synced = true;
            $toSync->save();
        }
        $this->sortField = 'synced';
        $this->sortDirection ='asc';
        return;
    }

    public function getUnsynced()
    {
        $data = Declaration::where('synced', true);
    }

    public function syncAll()
    {
        // DB::table('users')->count();
        $unSynced = Declaration::where('synced', false)->count();
        $this->notify($unSynced . ' Declaration not synchronized');
        $data = Declaration::where('synced', false)->with('enteredBy.staff')->chunk(10, function ($declarations) {
            // $this->notify('Declarations about to synchronize');
            foreach ($declarations as $declaration) {
                $response = Http::post('localhost:8880/api/declarations', $declaration->toArray());
                if ($response->body() == 'saved') {
                    $declaration->synced = true;
                    $declaration->save();
                // dd('saved');
                } else {
                    $this->notify('Sync failed');
                    // dd($response->body());
                }
            }
        });
    }

    public function render()
    {
        return view('livewire.declaration-data', [
            'declarations' => Declaration::search('declarant_name', $this->search)
            ->search('declared_on', $this->search)
            ->search('post', $this->search)
            ->search('schedule', $this->search)
            ->search('office_location', $this->search)
            ->search('address', $this->search)
            ->search('contact', $this->search)
            ->search('contact', $this->search)
            ->search('witness', $this->search)
            ->search('witness_occupation', $this->search)
            ->search('person_submitting', $this->search)
            ->search('person_submitting_contact', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20)
        ]);
    }
}
