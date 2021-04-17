<?php

namespace App\Mail;

use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;

    public $password ;
    public $url ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staff, $password)
    {
        $this->staff =  Staff::find($staff);

        $this->password  = $password;

        $this->url = route('login');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.password_reset');
    }
}
