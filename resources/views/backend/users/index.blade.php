@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('staff.user_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation">
                            <div class="form-group">
                                <label>{{ __('auth.username') }}</label>
                                <input type="text" class="form-control is-invalid" name="username" placeholder="username" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.email') }}</label>
                                <input type="email" class="form-control is-invalid" name="email" placeholder="name@example.com" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('staff.full_name') }}</label>
                                <input type="text" class="form-control is-invalid" name="fullName" placeholder="Name LastName" required>
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.password') }}</label>
                                <input id="password" type="password" class="form-control is-invalid" name="password" required autocomplete="new-password">
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
