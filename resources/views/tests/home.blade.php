@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @foreach([
    '英語' => 'red',
    '数学' => 'blue',
    '国語' => 'green',
    '社会' => 'purple',
    '理科' => 'orange'
    ] as $subject => $color)
    <div class="col-md-4 mb-4">
      <div class="card" style="border: 2px solid {{ $color }};">
        <div class="card-body">
          <h5 class="card-title" style="color: black;">{{ $subject }}</h5>
          <p class="card-text">こちらは{{ $subject }}のテスト一覧です。</p>
          <a href="{{ route('tests.subject', ['subject' => $subject]) }}" class="btn btn-outline"
            style="color: {{ $color }}; border-color: {{ $color }};">
            詳細を見る
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection