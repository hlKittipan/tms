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
                    <div class="card-header">{{ __('product.province_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.province.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('product.province_name') }}</label>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('product.province_management') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($province as $key => $list)
                                <tr>
                                    <td>{{ $key++ }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        <a href="{{ route('backend.province.edit',$list->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <!--<a href="" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                            <i class="fas fa-recycle fa-2x"></i>
                                        </a>-->
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $province->links() !!}
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
