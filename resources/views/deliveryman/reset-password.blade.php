@component('mail::message')
    <p>Hello {{ $deliveryman->deliveryman_name }}</p>

    @component('mail::button',['url' => url('deliveryman-reset-password/'.$deliveryman->verification_token)])
        Reset Password
    @endcomponent
    <p>In case if you have any issue, please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent