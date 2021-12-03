<?php

namespace SIMEA\Models;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'titulo', 'questionario_id', 'eixo_id'
  ];

  public function alternativas()
  {
    return $this->hasMany('SIMEA\Models\Alternativa');
  }

  public function questionario()
  {
    return $this->belongsTo('SIMEA\Models\Questionario');
  }

  public function eixo()
  {
    return $this->belongsTo('SIMEA\Models\Eixo');
  }
}
