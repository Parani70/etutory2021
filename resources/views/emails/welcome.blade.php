@component('mail::message')
# Welcome to eTutory! {{$data['studentname']}}

<p>We provide a rich array of opportunities for you to learn, to grow, to discover who you are, and how to reach your highest potential via the intellectual adventure.</p>
<p>We are thrilled to be partnering with you as you participate in an exciting educational journey of discovery. We will introduce you to all the environment, patterns, and types of examination.</p>

#Your User Name is : {{$data['studentuser']}}
    <p>You can login eTutory at any time and take an exam already purchased or purchase new exams and exam packages.</p>

    
Please click on the below link to confirm your email.
<a href="{{url('/emailactivation/'.$data['mailhash'])}}">{{url('/emailactivation/'.$data['mailhash'])}}</a>
<p>With Best wishes</p>
<p>From</p>
<p>eTutory Team</p>


{{ config('app.name') }}
@endcomponent
