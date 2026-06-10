<x-mail::message>
# Hello, {{ $name }}

Thank you for registering at AONE APEX ALLIANCE!

To complete your registration, please use the following One-Time Password (OTP). It is valid for 10 minutes.

<x-mail::panel>
**{{ $otp }}**
</x-mail::panel>

If you didn't request this, you can safely ignore this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
