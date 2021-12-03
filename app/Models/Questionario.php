<?php

namespace SIMEA\Models;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'titulo', 'disponivel', 'eixo_id'
  ];

  public function resultado()
  {
    return $this->hasMany('SIMEA\Models\Resultados');
  }

  public function questoes()
  {
    return $this->hasMany('SIMEA\Models\Questao');
  }

  public function eixo()
  {
    return $this->belongsTo('SIMEA\Models\Eixo');
  }

}
