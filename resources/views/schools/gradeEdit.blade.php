@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $grade->grade }}年生 {{ $GRADE_OBJ[$grade->term] }}の内申点登録</h2>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{ route('schools.grades.update', $grade->id) }}">
    @csrf
    @method('PUT')

    <div class="table-responsive">
      <table class="table table-bordered shadow-sm">
        <thead class="table-light">
          <tr>
            <th scope="col" class="text-center" style="width: 50%;">科目</th>
            <th scope="col" class="text-center" style="width: 50%;">内申点</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($SUBJECT_NAMES as $index => $subject)
          <tr>
            <td class="align-middle text-center">{{ $subject }}</td>
            <td>
              <input type="number" id="{{ $SUBJECT_COLUMNS[$index] }}" name="{{ $SUBJECT_COLUMNS[$index] }}"
                class="form-control"
                value="{{ old($SUBJECT_COLUMNS[$index], $grade->{$SUBJECT_COLUMNS[$index]} ?? '') }}" min="0" max="5">
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="d-flex mt-3 mb-3">
      <a href="{{ route('schools.index', ['grade' => $grade->grade]) }}" class="btn btn-secondary me-3">戻る</a>
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </form>
</div>
@endsection