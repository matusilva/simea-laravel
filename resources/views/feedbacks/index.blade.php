@extends('layouts.app')

@section('title')
  Feedbacks
@endsection

@section('content')
  <table class="responsive-table striped">
    <thead>
    <tr>
      <th>Feedback</th>
      <th>Nota</th>
    </tr>
    </thead>
    
    <tbody>
    <ul class="collapsible">
      <li>
        <div class="collapsible-header">
          <i class="material-icons">chat</i>
          Feedbacks coletados no total
          <span class="new badge" data-badge-caption="respostas">{{ $feedbacks->count() }}</span>
        </div>
        <div class="collapsible-body"><p>Total de feedbacks coletados pelos alunos ao responderem o
            questionário.</p></div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons">feedback</i>
          Alunos que exporam seu feedback
          <span class="new badge"
                data-badge-caption="feedbacks">{{ $feedbacks->where('feedback', !null)->count() }}</span>
        </div>
        <div class="collapsible-body"><p>Alunos que exporam seu feedback ao responder os questionários, dando também
            sua nota</p></div>
      </li>
    </ul>
    @foreach ($feedbacks as $feedback)
      @if ($feedback->feedback == null)
      @else
        <tr>
          <td>{{ $feedback->feedback }}</td>
          <td>{{ $feedback->nota }}</td>
        </tr>
      @endif
    @endforeach
    </tbody>
  </table>
@endsection