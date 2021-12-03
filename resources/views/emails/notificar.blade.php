@component('mail::message')
  # Olá, {{ $user->name }}!
  
  Notificamos que um novo questionário já está disponível para você responder
  
  @component('mail::panel', ['url' => ''])
    Basta clicar no botão abaixo e você será redirecionado ao questionário.
  @endcomponent
  
  @component('mail::button', ['url' => 'http://simea.ifrn.local/board', 'color' => 'green'])
    Acessar
  @endcomponent
  
  Obrigado,<br>
  Equipe {{ config('app.name') }}
@endcomponent
