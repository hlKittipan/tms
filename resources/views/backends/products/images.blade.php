@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('product.images')}}</div>

                    <div class="card-body">

                        <form class="was-validated needs-validation" method="POST" id="main-form"
                              action="{{ route('backend.product.image.update',$image->id) }}">
                            <input type="hidden" name="product_id" value="{{$image->product_id}}">
                            {{--<input type="hidden" name="id" value="{{$image->id}}">--}}
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <a href="{{new_asset($image->src)}}" target="_blank"> <img src="{{new_asset($image->src)}}" class="card-img-top"
                                                                                           alt="{{$image->alt}}"></a>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('product.title')</label>
                                        <input type="text" class="form-control" name="title" value="{{$image->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('product.description')</label>
                                        <textarea class="form-control" name="description">{{$image->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('product.alt')</label>
                                        <input type="text" class="form-control" name="alt" value="{{$image->alt}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('auth.save') }}</button>
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

        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


