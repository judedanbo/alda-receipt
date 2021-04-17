@component('mail::message')
# New password is ready

A new password has been generated for you

@component('mail::panel')
Username : {{$staff->user->username}}

Password : {{$password}}
@endcomponent

Remember to reset your password after logging in

You may login here

@component('mail::button', ['url' => $url ])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
