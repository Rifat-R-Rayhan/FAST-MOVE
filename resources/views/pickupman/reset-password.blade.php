@component('mail::message')
    <p>Hello {{ $pickupman->pickupman_name }}</p>

    @component('mail::button',['url' => url('pickupman-reset-password/'.$pickupman->verification_token)])
        Reset Password
    @endcomponent
    <p>In case if you have any issue, please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent