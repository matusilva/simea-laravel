<?php

namespace SIMEA;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SIMEA\Notifications\meuResetPassword;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'tipo_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];


  public function sendPasswordResetNotification($token)
  {
    $this->notify(new meuResetPassword($token));
  }

  public function pessoa()
  {
    return $this->hasOne('SIMEA\Models\Pessoa');
  }

  public function motivo()
  {
    return $this->hasOne('SIMEA\Models\Motivo');
  }

}
