@extends('layouts.app')

@section('content')
<div class="container">
  <h3><i class="bi bi-person-circle"></i> あなたのプロフィール</h3>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th>ID</th>
            <td>{{ $student->id }}</td>
          </tr>
          <tr>
            <th>名前</th>
            <td>{{ $student->family_name }} {{ $student->given_name }}</td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>{{ $student->email }}</td>
          </tr>
          <tr>
            <th>生年月日</th>
            <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('Y/m/d') }}</td>
          </tr>
          <tr>
            <th>入塾日</th>
            <td>{{ \Carbon\Carbon::parse($student->admission_date)->format('Y/m/d') }}</td>
          </tr>
          <tr>
            <th>退塾日</th>
            <td>{{ $student->withdrawal_date ? \Carbon\Carbon::parse($student->withdrawal_date)->format('Y/m/d') : '-'
              }}</td>
          </tr>
          <tr>
            <th>ステータス</th>
            <td>{{ $student->status }}</td>
          </tr>
          <tr>
            <th>登録日時</th>
            <td>{{ \Carbon\Carbon::parse($student->created_at)->format('Y/m/d H:i') }}</td>
          </tr>
          <tr>
            <th>最終更新日時</th>
            <td>{{ \Carbon\Carbon::parse($student->updated_at)->format('Y/m/d H:i') }}</td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex">
        <a href="{{ route('students.edit') }}" class="btn btn-primary">編集</a>
      </div>
    </div>
  </div>
</div>
@endsection