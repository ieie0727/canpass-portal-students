@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $grade->grade }}年生　{{ $GRADE_OBJ[$grade->term] }}の内申点登録</h2>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{ route('schools.grades.update', ['id' => $grade->id]) }}">
    @csrf
    @method('PUT')

    @foreach ($SUBJECT_NAMES as $index => $subject)
    <div class="mb-3">
      <label for="{{ $SUBJECT_COLUMNS[$index] }}" class="form-label">{{ $subject }}</label>
      <input type="number" id="{{ $SUBJECT_COLUMNS[$index] }}" name="{{ $SUBJECT_COLUMNS[$index] }}"
        class="form-control" value="{{ old($SUBJECT_COLUMNS[$index], $grade->{$SUBJECT_COLUMNS[$index]} ?? '') }}"
        min="1" max="5">
    </div>
    @endforeach

    <a href="{{ route('schools.index', ['id' => $grade->student_id, 'grade' => $grade->grade]) }}"
      class="btn btn-secondary me-3">戻る</a>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>
</div>
@endsection