@extends('mail.main_email')
@section('email_body')
<h1>Hi {{ $details['user']->first_name }},</h1>
<br>
<p>Your account was created successfully. Bellow are your login credentials</p>
<p><a href="{{ config('app.url') }}">Click here to log in</a></p>
<p>Email: <strong>{{ $details['user']->email  }}</strong></p> 
<p>Password: <strong>{{ $details['password'] }}</strong></p> 
<p>After a successfull login please remember to update your password</p>
<br>
<p>Regards,<br> {{ config('app.name') }}</p>
@endsection