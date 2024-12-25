@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $section->name }}の問題を解き直す</h2>

  @if($questions->isNotEmpty())
  <form method="POST" action="{{ route('tests.resubmit', ['section_id' => $section->id]) }}">
    @csrf

    @foreach($questions as $index => $question)
    <div class="card mb-4">
      <div class="card-header">
        <strong>問題 {{ $index + 1 }}</strong>
      </div>
      <div class="card-body">
        {{-- 問題文 --}}
        <p>{!! nl2br(e($question->question_text)) !!}</p>

        {{-- 画像がある場合に表示 --}}
        @if($question->question_image)
        <div class="mb-3">
          <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image" class="img-fluid">
        </div>
        @endif

        {{-- 選択肢 --}}
        <div>
          @foreach([1, 2, 3, 4] as $choice)
          <div class="form-check">
            <input type="radio" id="question_{{ $question->id }}_choice{{ $choice }}"
              name="answers[{{ $question->id }}]" value="{{ $choice }}" class="form-check-input" {{
              (isset($answers[$question->id]) && $answers[$question->id] == $choice) ? 'checked' : '' }} required>
            <label class="form-check-label" for="question_{{ $question->id }}_choice{{ $choice }}">
              {{ $question->{'choice' . $choice} }}
            </label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach

    {{-- ボタン --}}
    <div class="d-flex justify-content-start mb-3">
      <a href="{{ route('tests.subject', ['subject' => $section->subject]) }}" class="btn btn-secondary me-3">戻る</a>
      <button type="submit" class="btn btn-primary">再提出する</button>
    </div>
  </form>
  @else
  <p class="text-center text-muted">この単元には問題がありません。</p>
  @endif

</div>
@endsection