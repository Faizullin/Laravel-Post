@component('mail::message')
# Introduction

The body of your message.
{{-- 
@component('mail::button', ['url' => ''])
Button Text
@endcomponent
 --}}
<div class="h3">
Ваш Пароль: <p class="muted">{{ $data['password'] }}</p>
</div>
<a class="btn btn-primary" href="{{ route('personal.index') }}">Welcome {{ $data['name'] }}!</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
