@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('staff.user_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.user.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('auth.username') }}</label>
                                <input type="text" class="form-control is-invalid" name="username"
                                       value="{{ old('username') }}" placeholder="username" required>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.emails') }}</label>
                                <input type="email" class="form-control is-invalid" name="email"
                                       value="{{ old('emails') }}" placeholder="name@example.com" required>

                                @error('emails')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('staff.full_name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name" value="{{ old('name') }}"
                                       placeholder="Name LastName" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('auth.password') }}</label>
                                <input id="password" type="password" class="form-control is-invalid" name="password"
                                       required autocomplete="new-password">
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
                                <input id="password-confirm" type="password" class="form-control is-invalid"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
                            <button type="reset" class="btn btn-danger">{{ __('auth.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('staff.user_management') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($user as $key => $users)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $users->username }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>
                                        <a href="{{ route('backend.user.edit',$users->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <!--<a href="" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                            <i class="fas fa-recycle fa-2x"></i>
                                        </a>-->
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $user->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
