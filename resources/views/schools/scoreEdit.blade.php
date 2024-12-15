@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $score->grade }}年生　{{ $SCORE_OBJ[$score->term]}}の点数登録</h2>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{ route('schools.scores.update', ['id' => $score->id]) }}">
    @csrf
    @method('PUT')

    @foreach ($SUBJECT_NAMES as $index => $subject)
    <div class="mb-3">
      <label for="{{ $SUBJECT_COLUMNS[$index] }}" class="form-label">{{ $subject }}</label>
      <input type="number" id="{{ $SUBJECT_COLUMNS[$index] }}" name="{{ $SUBJECT_COLUMNS[$index] }}"
        class="form-control" value="{{ old($SUBJECT_COLUMNS[$index], $score->{$SUBJECT_COLUMNS[$index]} ?? '') }}"
        min="0" max="100">
    </div>
    @endforeach

    <a href="{{ route('schools.index', ['id' => $score->student_id, 'grade' => $score->grade]) }}"
      class="btn btn-secondary me-3">戻る</a>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>
</div>
@endsection