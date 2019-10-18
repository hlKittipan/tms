@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('setup.setting') }}</div>

                    <div class="card-body">
                        <form class=" " method="POST"
                              action="{{ route('backend.setup.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('setup.config') }}</label>
                                <input type="text" class="form-control" name="setting_name"
                                       value="{{ old('setting_name') }}" required>

                                @error('setting_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('setup.code') }}</label>
                                <input type="text" class="form-control" name="code"
                                       value="{{ old('code') }}" required>

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('setup.type') }}</label>
                                <select class="form-control" name="type">
                                    <option value="text" @if (old('type') == "text") {{ 'selected' }} @endif>Text</option>
                                    <option value="number" @if (old('type') == "number") {{ 'selected' }} @endif>Number</option>
                                    <option value="date" @if (old('type') == "date") {{ 'selected' }} @endif>Date</option>
                                    <option value="email" @if (old('type') == "email") {{ 'selected' }} @endif>E-mail</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
                            <button type="reset" class="btn btn-danger">{{ __('auth.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('setup.setting') }}</div>

                    <div class="card-body">
                        <form class="" method="GET"
                              action="{{ route('backend.setup.create') }}">
                            @csrf
                            @foreach($setting as $key => $value)
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">{{ $value->setting_name }}</label>
                                <div class="col-sm-6">
                                    <input type="{{$value->type}}" class="form-control" name="{{ $value->code }}" value="{{ $value->value }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <a href="" onclick="deleteData({{ $value->code }})"  data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fas fa-trash fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
                            <button type="reset" class="btn btn-danger">{{ __('auth.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form id="delete-form" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('input[name="setting_name"]').keyup(function(e) {
                var txtVal = $(this).val();
                txtVal = txtVal.toLowerCase().replace(/\s/g, '-');
                $('input[name="code"]').val(txtVal);
            });
        });
        function deleteData(code) {
            var url = '{{ url('backend/setup/') }}/'+code;
            document.getElementById('delete-form').action = url;
            setTimeout(function(){ document.getElementById('delete-form').submit(); }, 100);
        }
    </script>
@endsection
