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
                    <div class="card-header">{{__('product.images')}}</div>

                    <div class="card-body">

                        <form class="was-validated needs-validation" method="POST" id="main-form"
                              action="{{ route('backend.product_type.store') }}">
                            <input type="hidden" name="product_id" value="{{$product_id}}">
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
                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
                        </form>
                        <hr>
                        <div class="col-md-12">
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


