@component('mail::message')
{{-- # {{ $maildata['title'] }} --}}
{{$message}}
@component('mail::button', ['url' => 'https://www.thevirtualbd.com'])
Visit
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
