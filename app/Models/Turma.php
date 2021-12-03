<?php

namespace SIMEA\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'nome', 'curso_id'
  ];

  public function curso()
  {
    return $this->belongsTo('SIMEA\Models\Curso');
  }

  public function alunos()
  {
    return $this->hasMany('SIMEA\Models\Pessoa');
  }
}
