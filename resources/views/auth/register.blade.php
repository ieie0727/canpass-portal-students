@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Family Name -->
                        <div class="row mb-3">
                            <label for="family_name" class="col-md-4 col-form-label text-md-end">{{ __('Family Name')
                                }}</label>
                            <div class="col-md-6">
                                <input id="family_name" type="text"
                                    class="form-control @error('family_name') is-invalid @enderror" name="family_name"
                                    value="{{ old('family_name') }}" required autofocus>
                                @error('family_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Given Name -->
                        <div class="row mb-3">
                            <label for="given_name" class="col-md-4 col-form-label text-md-end">{{ __('Given Name')
                                }}</label>
                            <div class="col-md-6">
                                <input id="given_name" type="text"
                                    class="form-control @error('given_name') is-invalid @enderror" name="given_name"
                                    value="{{ old('given_name') }}" required>
                                @error('given_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Birth Date -->
                        <div class="row mb-3">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-end">{{ __('Birth Date')
                                }}</label>
                            <div class="col-md-6">
                                <input id="birth_date" type="date"
                                    class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                    value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Admission Date -->
                        <div class="row mb-3">
                            <label for="admission_date" class="col-md-4 col-form-label text-md-end">{{ __('Admission
                                Date') }}</label>
                            <div class="col-md-6">
                                <input id="admission_date" type="date"
                                    class="form-control @error('admission_date') is-invalid @enderror"
                                    name="admission_date" value="{{ old('admission_date') }}" required>
                                @error('admission_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection