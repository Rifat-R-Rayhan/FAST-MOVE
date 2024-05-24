@component('mail::message')
    <p>Hello {{ $pickupman->pickupman_name }}</p>

    @component('mail::button',['url' => url('verify/'.$pickupman->verification_token)])
        Verify
    @endcomponent
    <p>In case if you have any issue, please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent