<?php

namespace SIMEA\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class meuResetPassword extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {

    return (new MailMessage)
      ->subject('Redefinição de Senha')
      ->greeting('Olá!')
      ->line('Recebemos uma solicitação para redefinir a senha de sua conta.')
      ->line('Caso você tenha socilitado uma redefinição para sua senha, clique no Botão abaixo. caso contrário, ignore este email.')
      ->action('Redefinir senha', route('password.reset', $this->token))
      ->line('Obrigado por usar nosso Sistema!')
      ->line('Equipe SIMEA');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
