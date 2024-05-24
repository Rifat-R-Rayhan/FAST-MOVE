@component('mail::message')
    <p>Hello {{ $deliveryman->deliveryman_name }}</p>

    @component('mail::button',['url' => url('deliveryman-verify/'.$deliveryman->verification_token)])
        Verify
    @endcomponent
    <p>In case if you have any issue please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent