@component('mail::message')
# Introduction
Please click on the below link to change your password.
<a href="{{url('/passwordrestter/'.$data['mailhash'])}}">{{url('/passwordrestter/'.$data['mailhash'])}}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
