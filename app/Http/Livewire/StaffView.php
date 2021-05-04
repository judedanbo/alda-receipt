<?php

namespace App\Http\Livewire;

use App\Mail\AccountCreated;
use App\Mail\PasswordReset;
use App\Models\Office;
use App\Models\OfficeStaff;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class StaffView extends Component
{
    public $staff  ;

    public $offices;

    public $office_id ;
    public $username;

    public $assignOfficeModal = false ;
    public $makeUserModal = false ;

    public function mount($staff)
    {
        $this->staff =  Staff::findOrFail($staff);
        $this->offices = Office::all();

        activity()
            ->useLog('staff')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->staff)
            ->log('opened details of staff');
    }

    public function assignOffice(Request $request)
    {
        $validatedData = $this->validate([
            'office_id' => [
                    "required",
                    "integer",
                    "min:1",
                    "max:9999",
                    Rule::unique('office_staff')->where(function ($query) {
                        return $query->where('end_date', null)->where('staff_id', $this->staff->id);
                    })
                ],
        ], $messages=[
            'unique' => 'This staff has already been assigned to this office'
        ], $attributes=["office_id" => 'Office']);

        $selectedOffice = Office::find($this->office_id);
        
        $validatedData['staff_id'] = $this->staff->id;
        
        $this->staff->offices()->attach($selectedOffice);

        activity()
            ->useLog('staff')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->staff)
            ->log('staff assigned to the '. $selectedOffice->office_name . '('. $selectedOffice->office_id .") office");

        $emitMessage = $this->staff->full_name . ' has been assigned to ' . $this->offices->find($this->office_id)->office_name ;
        
        $this->emit($emitMessage);
        $this->assignOfficeModal = false;
        $this->staff->refresh();
    }
    public function makeUser()
    {
        $validatedData = $this->validate([
            'username' => 'required|string|max:255',
            
        ]);
        $defaultPassword = Str::random(8);
        $validatedData['staff_id'] = $this->staff->id;
        $validatedData['password'] = Hash::make($defaultPassword);

        User::create($validatedData);
        $emitMessage = $this->staff->full_name .' is now a user ';

        Mail::to($this->staff->email)
            ->queue(new AccountCreated($this->staff->id, $defaultPassword));

        activity()
            ->useLog('staff')
            ->withProperties([
                'session' => session()->all(),
            ])
            ->performedOn($this->staff)
            ->log('staff made a user');

        $this->emit($emitMessage);

        $this->staff->refresh();

        $this->makeUserModal = false;
    }
    
    public function resetPassword()
    {
        if ($this->staff->user) {
            $newPassword = Str::random(8);
            $newPasswordHash = Hash::make($newPassword);
            $this->staff->user->password = $newPasswordHash;
            $this->staff->user->save();

            

            $emitMessage = 'The password for '.$this->staff->full_name .' has been reset';

            Mail::to($this->staff->email)
                ->queue(new PasswordReset($this->staff->id, $newPassword));

            activity()
                ->useLog('staff')
                ->withProperties([
                    'session' => session()->all(),
                ])
                ->performedOn($this->staff)
                ->log('reset password of staff');

            $this->emit($emitMessage);
        }
    }

    public function render()
    {
        return view('livewire.staff-view', ['staff' => $this->staff]);
    }
}
