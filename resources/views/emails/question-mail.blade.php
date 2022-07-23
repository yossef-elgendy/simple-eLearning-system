@component('mail::message')
From: {{ $from }} <br>
To: yossef.elgendy55@gmail.com  <br>
subject:{{$subject}} <br>

{{$body}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
