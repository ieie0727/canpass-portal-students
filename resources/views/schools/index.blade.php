@extends('layouts.app')

@section('content')
<div class="container">
  @if(isset($message))
  <div class="alert alert-warning text-center">
    {{ $message }}
  </div>
  @else

  <!-- 名前表示と学年プルダウン -->
  <div class="d-flex justify-content-between align-items-end">
    <h2>{{ $student->family_name }} {{ $student->given_name }}さんの成績</h2>
    <form method="GET" action="{{ route('schools.index', ['id' => $student->id]) }}" class="mb-2">
      <select name="grade" class="form-select" onchange="this.form.submit()" style="width: auto; margin-top: 8px;">
        <option value="1" {{ request('grade')==='1' ? 'selected' : '' }}>１年生</option>
        <option value="2" {{ request('grade')==='2' ? 'selected' : '' }}>２年生</option>
        <option value="3" {{ request('grade')==='3' ? 'selected' : '' }}>３年生</option>
      </select>
    </form>
  </div>

  <!-- 定期テストのテーブル -->
  <h4 class="text-dark mb-2">定期テスト</h4>
  <div class="table-responsive">
    <table class="table table-bordered custom-table">
      <thead class="table-primary text-center custom-header">
        <tr>
          <th>項目</th>
          @foreach ($SUBJECT_NAMES as $subject)
          <th>{{ $subject }}</th>
          @endforeach
          <th>編集</th>
        </tr>
      </thead>

      <tbody>
        @for ($i = 1; $i <= 5; $i++) @php $scores_term=$scores->firstWhere('term', $i); @endphp
          <tr class="custom-row">
            <td>{{ $SCORE_OBJ[$i] }}</td>
            @foreach ($SUBJECT_COLUMNS as $subject)
            @php
            $score =$scores_term->{$subject} ?? 0;
            @endphp
            <td>{{ $score!==0 ? $score : '-' }}</td>
            @endforeach
          </tr>
          @endfor
      </tbody>
    </table>
  </div>

  <!-- 内申点のテーブル -->
  <h4 class="text-dark mb-2">内申点</h4>
  <div class="table-responsive">
    <table class="table table-bordered custom-table">
      <thead class="table-success text-center custom-header">
        <tr>
          <th>項目</th>
          @foreach ($SUBJECT_NAMES as $subject)
          <th>{{ $subject }}</th>
          @endforeach
          <th>編集</th>
        </tr>
      </thead>

      <tbody>
        @for ($i = 1; $i <= 4; $i++) @php $grades_term=$grades->firstWhere('term', $i); @endphp
          <tr class="custom-row">
            <td>{{ $GRADE_OBJ[$i] }}</td>
            @foreach ($SUBJECT_COLUMNS as $subject)
            @php
            $grade =$grades_term->{$subject} ?? 0;
            @endphp
            <td>{{ $grade!==0 ? $grade : '-' }}</td>
            @endforeach
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
  @endif
</div>
@endsection

<style>
  /* テーブル全体の罫線を濃くする */
  .custom-table,
  .custom-table th,
  .custom-table td {
    border: 1px solid #666 !important;
    text-align: center !important;
    vertical-align: middle !important;
  }

  /* ヘッダーのスタイル */
  .custom-header {
    color: #333;
    background-color: #f8f9fa;
  }

  /* ボディのスタイル */
  .custom-row {
    color: #222;
    font-size: 1rem;
    background-color: #fff;
  }

  /* 見出しのスタイル */
  h4 {
    margin-bottom: 0.5rem !important;
    /* テーブルとの間隔を最小限に調整 */
    color: #000 !important;
  }

  h3 {
    color: #000 !important;
  }
</style>