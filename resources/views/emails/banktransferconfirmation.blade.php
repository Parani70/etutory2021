@component('mail::message')
# Payment Receipt

#Congratulations!
@component('mail::panel')
You have successfully reserved Following exams/Packages:
@endcomponent
@component('mail::table')
Description       | Grade         | Price  |
| ------------- |:-------------:| --------:|
| {{$data['examname'].'  '.$data['subject']}}    | {{$data['grade']}}      | {{$data['price']}}       |

@endcomponent


@component('mail::panel')
We will validate the payment and send a confirmation. From the confirmation date, you will have 30 days to login to eTutory and sit for any of the purchased exams at any time.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
