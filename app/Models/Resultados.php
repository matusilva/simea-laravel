<?php

namespace SIMEA\Models;

use Illuminate\Database\Eloquent\Model;

class Resultados extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'pontos', 'pessoa_id', 'eixo_id', 'questionario_id', 'questao_id'
  ];

  public function aluno()
  {
    return $this->belongsTo('SIMEA\Models\Pessoa');
  }

  public function eixo()
  {
    return $this->belongsTo('SIMEA\Models\Eixo');
  }

  public function questionario()
  {
    return $this->belongsTo('SIMEA\Models\Questionario');
  }

  public function questao()
  {
    return $this->belongsTo('SIMEA\Models\Questao');
  }

}
