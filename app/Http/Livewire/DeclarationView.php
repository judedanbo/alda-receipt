<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Declaration;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class DeclarationView extends Component
{
    public $declaration;

    public function mount(Declaration $declaration)
    {
        $this->declaration = $declaration;
        activity()
            ->useLog('declaration')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->declaration)
            ->log('opened details of declaration');
    }

    public function receipt()
    {
        redirect()->route('declaration.receipt', ['declaration' => $this->declaration]);
    }

    public function generateQrCode()
    {
        $this->declaration->qrcode = Str::random (15);
        $this->declaration->save();
    }

    public function new()
    {
        redirect()->route('declaration.form');
    }
    public function edit()
    {
        redirect()->route('declaration.form', ['declaration' => $this->declaration]);
    }

    public function sync()
    {
        if ($this->declaration->synced === false) {
            $client = new Client([]);
            $promise = $client->postAsync('localhost:8880/api/declarations', ['form_params' => [$this->declaration->toArray()]]);
            // dd($this->declaration->toArray());
            $promise->then(
                function (ResponseInterface $res) {
                    // dd($res->getBody()->getContents());
                    if ($res->getBody()->getContents() == 'saved') {
                        $this->declaration->synced = true;
                        $this->declaration->save();
                        $this->declaration->refresh();
                        $this->notify('declaration for '. $this->declaration->declarant_name .' has been synchronized');
                        activity()
                            ->useLog('declaration sync')
                            ->withProperties([
                                'session' => session()->all(),
                            ])
                            ->performedOn($this->declaration)
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
                    activity()
                        ->useLog('declaration sync')
                        ->withProperties([
                            'session' => session()->all(),
                        ])
                        ->log('failed to syc: '.$e);
                }
            );
            $promise->wait();
        }

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

    public function getConnectedProperty()
    {
        $client = new Client([]);
        $promise = $client->getAsync('localhost:8880/api/declarations');
        $promise->then(
            function (ResponseInterface $res) {
                if ($res->getBody()->getContents() == 'all declarations') {
                    return true;
                }
            }
        );
        return false;
    }



    public function render()
    {
        return view('livewire.declaration-view');
    }
}