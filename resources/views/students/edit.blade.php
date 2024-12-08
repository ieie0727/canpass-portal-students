@extends('layouts.app')

@section('content')
<div class="container">
  <h3><i class="bi bi-pencil-square"></i> 生徒情報編集</h3>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('students.update', ['id' => $student->id]) }}">
        @csrf
        @method('PUT')

        <!-- 名前 -->
        <div class="mb-3">
          <label for="family_name" class="form-label">名字</label>
          <input type="text" id="family_name" name="family_name"
            class="form-control @error('family_name') is-invalid @enderror"
            value="{{ old('family_name', $student->family_name) }}" required>
          @error('family_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="given_name" class="form-label">名前</label>
          <input type="text" id="given_name" name="given_name"
            class="form-control @error('given_name') is-invalid @enderror"
            value="{{ old('given_name', $student->given_name) }}" required>
          @error('given_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- メールアドレス -->
        <div class="mb-3">
          <label for="email" class="form-label">メールアドレス</label>
          <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $student->email) }}" required>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- 生年月日 -->
        <div class="mb-3">
          <label for="birth_date" class="form-label">生年月日</label>
          <input type="date" id="birth_date" name="birth_date"
            class="form-control @error('birth_date') is-invalid @enderror"
            value="{{ old('birth_date', $student->birth_date) }}" required>
          @error('birth_date')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- ボタン -->
        <div class="d-flex">
          <a href="{{ route('students.show', ['id' => $student->id]) }}" class="btn btn-secondary me-3">戻る</a>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection