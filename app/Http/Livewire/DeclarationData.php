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
use Psr\Http\Message\ResponseInterface;

class DeclarationData extends Component
{
    use WithPagination;
    public $declaration;
    public $declaration_id;
    public $search;

    public $sortField = 'declared_on' ;
    public $sortDirection = 'desc' ;

    public $connectedToServer = false;

    public $showFormModal = false;

    // public $connectedToServer;

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

    public function mount()
    {
        activity()
            ->useLog('declaration')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->log('opened all declarations');
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
            $office_number = Auth::user()->staff->current_office->office_id;
            $office_id = Auth::user()->staff->current_office->id;
        } else {
            $office_number = 'X0' ;
            $office_id = 1;
        }

        $total = DB::table('declarations')->count();

        $validatedStaff['user_id'] = Auth::id();
        $validatedStaff['office_id'] = $office_id;
        $validatedStaff['qrcode'] = Str::random(15);
        $validatedStaff['receipt_no'] = $office_number . Str::padLeft($total + 1, 5, '0');

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

    // public function updateSync()
    // {
    //     $toSync->synced = true;
    //     $toSync->save();
    // }

    public function syncOne($declarationToSync)
    {
        $toSync =  Declaration::with(['enteredBy.staff', 'office'])->find($declarationToSync);
        if ($this->connectedToServer === true) {
            if ($toSync->synced === false) {
                $client = new Client();
                $promise = $client->postAsync('localhost:8880/api/declarations', [
                    'form_params' => [$toSync->toArray()],
                    'timeout' => 15
                    ]);
                // dd($promise);
                $promise->then(
                    function (ResponseInterface $res) use ($toSync) {
                        if ($res->getBody()->getContents() == 'saved') {
                            $toSync->synced = true;
                            $toSync->save();
                            $toSync->refresh();
                            $this->notify('declaration for '. $toSync->declarant_name .' has been synchronized');

                            activity()
                                ->useLog('declaration sync')
                                ->withProperties([
                                    'session' => session()->all(),
                                ])
                                ->performedOn($toSync)
                                ->log('synced with server');
                        } else {
                            activity()
                                ->useLog('declaration sync')
                                ->withProperties([
                                    'session' => session()->all(),
                                ])
                                ->log('data sent but could not sync error: '.$res->getBody());
                        }
                    },
                    function (RequestException $e) {
                        // dd('error');
                        activity()
                            ->useLog('declaration sync')
                            ->withProperties([
                                'session' => session()->all(),
                            ])
                            ->log('failed to syc: '.$e);
                    }
                );
                $promise->wait();
                // dd('after');
            }
        }

        // $response = Http::post('localhost:8880/api/declarations', $toSync->toArray());
        // if ($response->body() == 'saved') {
        //     $toSync->synced = true;
        //     $toSync->save();
        // }
        // $toSync->refresh();
        // $this->sortDirection ='asc';
    }

    public function getUnSynced()
    {
        $data = Declaration::where('synced', true);
    }

    public function syncAll()
    {
        // DB::table('users')->count();
        $unSynced = Declaration::where('synced', false);
        if ($unSynced->count() > 0) {
            $this->notify($unSynced->count() . ' ' . Str::plural("Declaration", $unSynced->count()). ' not synchronized');
            $this->syncOne($unSynced->first()->id);
        }

        // $data = Declaration::where('synced', false)->with('enteredBy.staff')->chunk(2, function ($declarations) {
        //     // $this->notify('Declarations about to synchronize');
        //     foreach ($declarations as $declaration) {
        //         $response = Http::post('localhost:8880/api/declarations', $declaration->toArray());
        //         if ($response->body() == 'saved') {
        //             $declaration->synced = true;
        //             $declaration->save();
        //         // dd('saved');
        //         } else {
        //             $this->notify('Sync failed');
        //             // dd($response->body());
        //         }
        //     }
        // });
    }

    // public function getConnectedToServerProperty()
    // {
    //     return $this->online();
    // }

    public function online()
    {
        try {
            $client = new Client();
            $promise = $client->getAsync('localhost:8880/api/declarations', ['timeout' => 5]);
            // $response = Http::timeout(3)->get('localhost:8880/api/declarations');
            $promise->then(
                function (ResponseInterface $res) {
                    $this->connectedToServer = true;
                },
                function (RequestException $e) {
                    // dd('failed');
                    $this->connectedToServer = false;
                    // dd($e->getMessage());
                    // $promise->reject('Error!');
                }
            );

            // $promise->resolve(' .');
            $promise->wait();

            // if ($response->successful()) {
            //     return true;
            // }
        } catch (\Throwable $th) {
            // dd($th);
            $this->connectedToServer = false;
        }
        
        // $response->wait();
        
        return ;
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
