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
                    <div class="card-header">{{ __('book.add_booking') }}</div>
                    <div class="card-body">
                        <form class="" method="POST" id="main-form"
                              action="{{route('backend.product.period.store')}}">
                            @csrf

                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4>@lang('book.product_list')</h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-12" id="product_list">

                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('book.search_product') }}</label>
                                    <select class="form-control" id="searchProduct"></select>
                                </div>
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
        var urlSearch = '{{route('api.search.product')}}';
        var urlCheckAvailable = '{{route('api.search.product.available')}}';
        var lg_available = '{{__('book.available')}}';
        var lg_adult = '{{__('book.adult')}}';
        var lg_child = '{{__('book.child')}}';
        var lg_infant = '{{__('book.infant')}}';
        var lg_number_of_adult = '{{__('book.number_of_adult')}}';
        var lg_number_of_child = '{{__('book.number_of_child')}}';
        var lg_number_of_infant = '{{__('book.number_of_infant')}}';
        var lg_discounts = '{{__('book.discounts')}}';
        var lg_total = '{{__('book.total')}}';
        var lg_vat = '{{__('book.vat')}}';
        var lg_net_total = '{{__('book.net_total')}}';
        var lg_id = '{{__('book.id')}}';
        var lg_product_name = '{{__('book.product_name')}}';

        $(function() {


        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
    <script src="{{ asset('js/backend/booking.js') }}" ></script>
@endsection


