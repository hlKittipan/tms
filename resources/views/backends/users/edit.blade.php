@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('staff.user_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.user.update',$user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('auth.username') }}</label>
                                <input type="text" class="form-control " name="username"
                                       value="{{ $user->username }}" placeholder="username" disabled>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.email') }}</label>
                                <input type="email" class="form-control " name="email"
                                       value="{{ $user->email }}" placeholder="name@example.com" disabled>
                            </div>

                            <div class="form-group">
                                <label>{{ __('staff.full_name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name" value="{{ $user->name }}"
                                       placeholder="Name LastName" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.password') }}</label>
                                <input id="password" type="password" class="form-control is-invalid" name="password">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Your Password minimum 6.
                                </small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

