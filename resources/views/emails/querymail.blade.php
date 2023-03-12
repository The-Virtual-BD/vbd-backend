@component('mail::message')

{{$message}}
@component('mail::button', ['url' => 'https://www.thevirtualbd.com'])
Visit
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
