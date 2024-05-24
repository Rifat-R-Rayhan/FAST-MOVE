@component('mail::message')
    <p>Hello {{ $delivery->customer_name }}</p>
    <p>Here is your product tracking id: {{$delivery->order_tracking_id}}</p>
    <p>& product id: {{$delivery->id}}</p>
    <br>

    <p>In case if you have any issue, please contact us: {{$delivery->user->phone}}</p>
    Thanks <br>
    {{ config('app.name') }}
@endcomponent