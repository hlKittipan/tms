@extends('backends.layouts.app')

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
                    <div class="card-header">{{ __('product.create') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.product_type.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('product.name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name"
                                       value="{{ old('name') }}" placeholder="name" required>

                                @error('name')
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

