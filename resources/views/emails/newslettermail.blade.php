@component('mail::message')
@if ($newsletter->image)
    <div style="margin-bottom: 20px">
        <img src="{{asset($newsletter->image)}}" alt="" width="100%">
    </div>
@endif
{{$newsletter->text }}
@component('mail::button', ['url' => $newsletter->link ? $newsletter->link : 'https://www.thevirtualbd.com'])
Visit
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
