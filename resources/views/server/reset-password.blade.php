@component('mail::message')
    <p>Hello {{ $admin->admin_name }}</p>

    @component('mail::button',['url' => url('admin-reset-password/'.$admin->verification_token)])
        Reset Password
    @endcomponent
    <p>In case if you have any issue, please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent