@component('mail::message')
# Introduction
<table border='1px solid'>
<thead>
<tr><th>A</th><th>B</th></tr>
</thead>
</table>
The body of your message.
asasasz asasas

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
