@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $subject }}の単元一覧</h2>

  {{-- 教科ごとの背景色を定義 --}}
  @php
  $headerColors = [
  '英語' => 'background-color: #ffcccc;', // 薄い赤
  '数学' => 'background-color: #cce5ff;', // 薄い青
  '国語' => 'background-color: #d4edda;', // 薄い緑
  '社会' => 'background-color: #e2d6f8;', // 薄い紫
  '理科' => 'background-color: #ffe5b4;', // 薄いオレンジ
  ];
  $subjectStyle = $headerColors[$subject] ?? 'background-color: #f8f9fa;'; // デフォルト色
  @endphp

  @if($sections->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-bordered custom-table">
      <thead class="custom-header" style="{{ $subjectStyle }}">
        <tr>
          <th class="text-center">番号</th>
          <th>単元名</th>
          <th class="text-center">問題数</th>
          <th class="text-center">合格点</th>
          <th class="text-center">正解数</th>
          <th class="text-center">結果</th>
          <th class="text-center">詳細</th>
          <th class="text-center">リンク</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $section)
        @php
        $record = $records->firstWhere('section_id', $section->id);
        $correctIds = $record && $record->corrects ? array_filter(explode(',', $record->corrects)) : [];
        $correctCount = count($correctIds);
        @endphp
        <tr class="custom-row">
          <td class="text-center">{{ $section->number }}</td>
          <td>{{ $section->name }}</td>
          <td class="text-center">{{ $section->questions_count }}</td>
          <td class="text-center">{{ $section->passing_score }}</td>
          <td class="text-center">{{ $correctCount }}</td>
          <td class="text-center">
            @if($record)
            @if($record->is_passed)
            <span class="badge bg-success">合格</span>
            @else
            <span class="badge bg-danger">不合格</span>
            @endif
            @else
            <span class="badge bg-secondary">未受験</span>
            @endif
          </td>
          <td class="text-center">
            @if($record)
            <a href="{{ route('tests.record', ['section_id' => $section->id]) }}" class="btn btn-info btn-sm">詳細を見る</a>
            @else
            ー
            @endif
          </td>
          <td class="text-center">
            @if($record)
            <a href="{{ route('tests.retry', ['section_id' => $section->id]) }}" class="btn btn-warning btn-sm">解き直す</a>
            @else
            <a href="{{ route('tests.try', ['section_id' => $section->id]) }}" class="btn btn-primary btn-sm">解答する</a>
            @endif
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
  @else
  <p class="text-center text-muted">この教科には単元がありません。</p>
  @endif

  {{-- 戻るボタン --}}
  <div class="text-center mt-4">
    <a href="{{ route('tests.home') }}" class="btn btn-secondary">教科一覧に戻る</a>
  </div>
</div>
@endsection

<style>
  /* テーブル全体の罫線を濃くする */
  .custom-table,
  .custom-table th,
  .custom-table td {
    border: 1px solid #333 !important;
    text-align: center !important;
    vertical-align: middle !important;
  }

  /* ヘッダーのスタイル */
  .custom-header {
    color: #000;
    font-weight: bold;
  }

  /* 通常の行の文字色を黒に設定 */
  .custom-row {
    background-color: #fff;
    color: #000 !important;
  }

  /* バッジのスタイル */
  .badge {
    font-size: 1rem;
    padding: 0.5em 0.75em;
    border-radius: 0.5rem;
  }

  .bg-success {
    background-color: #28a745 !important;
    color: #fff !important;
  }

  .bg-danger {
    background-color: #dc3545 !important;
    color: #fff !important;
  }

  .bg-secondary {
    background-color: #6c757d !important;
    color: #fff !important;
  }
</style>