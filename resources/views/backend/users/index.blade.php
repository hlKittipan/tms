@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('staff.user_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST" action="{{ route('backend.user.store') }}">
                                @csrf
                            <div class="form-group">
                                <label>{{ __('auth.username') }}</label>
                                <input type="text" class="form-control is-invalid" name="username" value="{{ old('username') }}" placeholder="username" required>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.email') }}</label>
                                <input type="email" class="form-control is-invalid" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('staff.full_name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name" value="{{ old('name') }}" placeholder="Name LastName" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.password') }}</label>
                                <input id="password" type="password" class="form-control is-invalid" name="password" required autocomplete="new-password">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Your Password minimum 6.
                                </small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.confirm_password') }}</label>
                                <input id="password-confirm" type="password" class="form-control is-invalid" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
                            <button type="reset" class="btn btn-danger">{{ __('auth.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
