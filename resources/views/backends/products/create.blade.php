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
                <div class="card">
                    <div class="card-header">{{ __('product.create') }}</div>

                    <div class="card-body">

                        <form class="was-validated needs-validation" method="POST" id="main-form"
                              action="{{ route('backend.product.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>{{ __('product.name') }}</label>
                                    <input type="text" class="form-control is-invalid" name="name"
                                           value="{{ old('name') }}" placeholder="name" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('product.number_of_pax') }}</label>
                                    <input type="number" class="form-control is-invalid" name="number_of_pax"
                                           value="{{ old('number_of_pax') }}" placeholder="30" required>

                                    @error('number_of_pax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('product.duration_days') }}</label>
                                    <input type="number" class="form-control" name="duration_days"
                                           value="{{ old('duration_days') }}" placeholder="30">

                                    @error('duration_days')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ __('product.duration_nights') }}</label>
                                    <input type="number" class="form-control" name="duration_nights"
                                           value="{{ old('duration_nights') }}" placeholder="30">

                                    @error('duration_nights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.product_type') }}</label>
                                <select class="form-control  is-invalid" name="product_type">
                                    @foreach($productType as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.includes') }}</label>
                                <textarea class="form-control" name="includes" placeholder="Required"
                                          rows="3">{{ old('includes') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.excludes') }}</label>
                                <textarea class="form-control" name="excludes" placeholder="Required"
                                          rows="3">{{ old('excludes') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.conditions') }}</label>
                                <textarea class="form-control" name="conditions" placeholder="Required"
                                          rows="3">{{ old('conditions') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.itinerary') }}</label>
                                <textarea class="form-control" name="itinerary" placeholder="Required"
                                          rows="3">{{ old('itinerary') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.remark') }}</label>
                                <textarea class="form-control" name="remark" placeholder="Required"
                                          rows="3">{{ old('remark') }}</textarea>
                            </div>
                            <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault();document.getElementById('main-form').submit();">{{ __('auth.save') }}</button>
                            <button type="button" class="btn btn-danger"
                                    onClick="confirm_reset()">{{ __('auth.reset') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if ('{{$product_id}}' != '0') {
                $('#nav-tab a[href="#nav-image"]').tab('show');
                $('#nav-main').empty();
            }
        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


