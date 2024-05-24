@component('mail::message')
    <p>Hello {{ $localUser->customer_name }}</p>
    <p>Here is your product tracking id: {{$localUser->order_tracking_id}}</p>
    <p>& product id: {{$localUser->id}}</p>
    <br>

    <p>In case if you have any issue, please contact us.</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent