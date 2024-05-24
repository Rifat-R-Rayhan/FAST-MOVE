<x-mail::message>
    # Introduction

    Dear Subscriber,

    Thank you for subscribing to our newsletter. Now you can get all updates of our service.

    @component('mail::button', ['url' => 'https://fastmovebd.com/'])
        Read More
    @endcomponent

    If you have any questions or feedback, feel free to reply to this email.

    Regards,<br>
    {{ config('app.name') }}
</x-mail::message>