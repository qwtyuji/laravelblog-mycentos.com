@component('mail::message')
# 重置密码链接

@component('mail::button', ['url' => ''])
重置
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
