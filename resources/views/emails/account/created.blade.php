@component('mail::message')
# Your account is created

Dear {{$staff->full_name}},

An account has been created for you on the Ghana Audit Service Asset and Liability Declaration (ALDA) Receipt System

Your account details are as follows

@component('mail::panel')
Username: {{$staff->user->username}} 

password:  {{$password}}
@endcomponent


Remember to reset your password after logging in

You may login here
@component('mail::button', ['url' => $url])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
