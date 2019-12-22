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
                    <div class="card-header">{{ __('transport.transport_management') }}</div>

                    <div class="card-body">
                        <form class="was-validated needs-validation" method="POST"
                              action="{{ route('backend.transport.store') }}">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="type" value="Transport">
                            <div class="form-group">
                                <label>{{ __('transport.name') }}</label>
                                <input type="text" class="form-control is-invalid" name="name"
                                       value="{{ old('name') }}" placeholder="name" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('transport.price') }}</label>
                                <input type="number" class="form-control is-invalid" name="price"
                                       value="{{ old('price') }}" required>

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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('transport.transport_management') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($result as $key => $list)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->price }}</td>
                                    <td>
                                        <a href="{{ route('backend.transport.edit',$list->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove" onclick="event.preventDefault();
                                                     document.getElementById('hidden-form').submit();">
                                            <i class="fas fa-trash fa-2x"></i>
                                        </a>

                                        <form id="hidden-form" action="{{ route('backend.transport.destroy',$list->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <!--<a href="" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                            <i class="fas fa-recycle fa-2x"></i>
                                        </a>-->
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $result->links() !!}
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
