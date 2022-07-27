@component('mail::message')
# Introduction

{{$inviter->first_name+' '+$inviter->last_name}} has invited you to Project to work together
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
