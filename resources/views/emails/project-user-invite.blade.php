@component('mail::message')
# Introduction

The body of your message.

Email: {{ $email }}

Name: {{ $name }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
