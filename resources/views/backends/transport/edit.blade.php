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
                    <div class="card-header">{{ __('transport.transport_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.transport.update',$transport->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('transport.name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name" value="{{ $transport->name }}"
                                       placeholder="Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('transport.price') }}</label>
                                <input type="text" class="form-control is-invalid" name="price" value="{{ $transport->price }}" required>
                                @error('price')
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

