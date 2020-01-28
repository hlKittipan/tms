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
                              action="{{route('backend.booking.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4>{{__('book.customer_name')}}</h4>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.first_name')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="first_name" class="form-control" placeholder="{{__('book.first_name')}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.last_name')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="last_name" class="form-control" placeholder="{{__('book.last_name')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.email')}}</label>
                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.upload_passport')}}</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="passport" class="form-control-file" multiple
                                                       accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.hotel_name')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="hotel_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.hotel_tel')}}</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="hotel_tel" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.room_number')}}</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="room_number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4>@lang('book.product_list')</h4>
                                        <hr>
                                    </div>

                                    <div class="col-md-12" id="product_list">

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('book.search_product') }} </label>
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
    <!-- Modal -->
    <div class="modal fade" id="alertMessage" tabindex="-1" role="dialog" aria-labelledby="alertMessageLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertMessageLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="alertMessageBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
        var lg_date = '{{__('product.date')}}';
        var lg_add_transport = '{{__('transport.add_transport')}}'
        var transportList = "";
        $(function () {

        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
    <script src="{{ new_asset('js/backend/booking.js') }}"></script>
@endsection


