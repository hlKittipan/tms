@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('product.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" id="main-form"
                              action="{{ route('backend.product.update',$product->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>{{ __('product.name') }}</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{$product->name}}" placeholder="name" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('product.number_of_pax') }}</label>
                                    <input type="number" class="form-control " name="number_of_pax"
                                           value="{{$product->number_of_pax}}" placeholder="30" required>

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
                                           value="{{$product->duration_days}}" placeholder="30">

                                    @error('duration_days')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ __('product.duration_nights') }}</label>
                                    <input type="number" class="form-control" name="duration_nights"
                                           value="{{$product->duration_nights}}" placeholder="30">

                                    @error('duration_nights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.product_type') }}</label>
                                <select class="form-control  " name="product_type_id">
                                    @foreach($productType as $key => $value)
                                        <option value="{{$key}}" @if($product->product_type_id == $key) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.overview') }}</label>
                                <textarea class="form-control" name="overview" id="overview" placeholder="Required"
                                          rows="3">{{$product->overview}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.includes') }}</label>
                                <textarea class="form-control" name="includes" placeholder="Required"
                                          rows="3">{{$product->includes}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.excludes') }}</label>
                                <textarea class="form-control" name="excludes" placeholder="Required"
                                          rows="3">{{$product->excludes}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.conditions') }}</label>
                                <textarea class="form-control" name="conditions" placeholder="Required"
                                          rows="3">{{$product->conditions}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.itinerary') }}</label>
                                <textarea class="form-control" name="itinerary" placeholder="Required"
                                          rows="3">{{$product->itinerary}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.remark') }}</label>
                                <textarea class="form-control" name="remark" placeholder="Required"
                                          rows="3">{{$product->remark}}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            if ('{{$product->id}}' != '0') {
                $('#nav-tab a[href="#nav-image"]').tab('show');
                $('#nav-main').empty();
            }

            CKEDITOR.replaceAll();
        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


