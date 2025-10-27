@component('mail::message')
# {{ $form['document'] }}

Se ha generado un nuevo documento y se ha enviado a su correo electrónico.
<br>
Gracias por confiar en nosotros.<br>
<b>{{ config('app.name') }}</b>

@endcomponent
