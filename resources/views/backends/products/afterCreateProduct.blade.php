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
                    <div class="card-header">@lang('product.information')</div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.product')</h4>
                            </div>
                            <hr>
                            <div class="form-group col-md-4">
                                <label><b>@lang('product.id') : </b> {{ $product->id }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>@lang('product.name') : </b> {{$product->name}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.periods')</h4>
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <a href="{{route('backend.product.period.create',$product->id)}}" class="btn btn-success">@lang('product.add_periods')</a>
                            </div>
                            <div class="form-group col-md-12" id="panel_periods">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.images')</h4>
                            </div>
                            <hr>
                            <form class="was-validated needs-validation" method="POST" action="">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('product.main') @lang('product.images')</label>
                                    <input type="file" class="form-control-file" name="main" accept="image/*">
                                    <small class="form-text text-muted">Choose 1</small>
                                </div>

                                <div class="form-group">
                                    <label>@lang('product.gallery')</label>
                                    <input type="file" class="form-control-file" name="gallery" multiple
                                           accept="image/*">
                                    <small class="form-text text-muted">Choose 1 or more</small>
                                </div>
                                <button type="submit" class="btn btn-success">{{ __('product.add_images') }}</button>
                            </form>
                            <hr><br>
                            <div class="form-group col-md-12" id="panel_images">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                                <img src="{{asset('img/dummy-200x200.png')}}" class="img-fluid rounded "
                                     alt="Responsive image">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('backend.product.index') }}" type="submit"
                           class="btn btn-primary">{{ __('product.done') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


