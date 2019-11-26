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
                    <div class="card-header">{{ __('book.edit_booking') }}</div>
                    <div class="card-body">
                        <form class="" method="POST" id="main-form"
                              action="{{route('backend.booking.update',$quotation->quo_id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{$quotation->quo_id}}" name="quotation_id" readonly>
                            <input type="hidden" value="{{$quotation->client_id}}" name="client_id" readonly>
                            <input type="hidden" value="{{$quotation->staff_id}}" name="staff_id" readonly>
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
                                                <input type="text" name="first_name" class="form-control" value="{{$quotation->first_name}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.last_name')}}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="last_name" class="form-control" value="{{$quotation->last_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.email')}}</label>
                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control" value="{{$quotation->email}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.upload_passport')}}</label>
                                            @if(is_null($quotation->passport) || empty($quotation->passport))
                                                <div class="col-sm-4">
                                                    <input type="file" name="passport" class="form-control-file">
                                                </div>
                                            @else
                                                <div class="col-sm-4">
                                                    <a href="{{asset($quotation->passport)}}" target="_blank"> <img src="{{asset($quotation->passport)}}" class="card-img-top"></a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.hotel_name')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="hotel_name" class="form-control" value="{{$quotation->hotel_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{__('book.hotel_tel')}}</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="hotel_tel" class="form-control" value="{{$quotation->hotel_tel}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">{{__('book.room_number')}}</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="room_number" class="form-control" value="{{$quotation->room_number}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4>@lang('book.product_list')</h4>
                                        <hr>
                                    </div>

                                    <div class="col-md-12" id="product_list">
                                        @foreach($quotation->quo_detail as $value)
                                            <div class="card mb-3" id="list_id_{{$value->product_id}}">
                                                <div class="card-header"><b>{{__('book.id')}}</b> : {{$value->product_id}}  <b>{{__('product.name')}}</b> : {{$value->name}}
                                                    <span class="float-right" id="available_span_{{$value->product_id}}" number_of_pax="{{$value->number_of_pax}}"></span>
                                                    <input type="hidden" name="product_id[]" value="{{$value->product_id}}">
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="form-group col-md-12">
                                                                <label><b>{{__('book.adult')}} : </b>{{$value->public_adult}}</label>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label><b>{{__('book.child')}} : </b>{{$value->public_child}}</label>
                                                            </div>
                                                            <div class="form-group col-md-12 hide">
                                                                <label><b>{{__('book.infant')}} : </b>{{$value->public_infant}}</label>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">{{__('product.date')}}</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="date_{{$value->product_id}}" class="form-control form-date" onchange="checkAvailable('{{$value->product_id}}','{{$value->number_of_pax}}')" value="{{\Carbon\Carbon::parse($value->book_date)->format('m/d/Y')}}">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.number_of_adult')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="noa_{{$value->product_id}}" class="form-control text-right" value="{{$value->unit_adult}}" onchange="calculatePrice('{{$value->product_id}}','noa_')" price="{{$value->public_adult}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.number_of_child')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="noc_{{$value->product_id}}" class="form-control text-right" value="{{$value->unit_child}}" onchange="calculatePrice('{{$value->product_id}}','noc_')" price="{{$value->public_child}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row hide">
                                                                <label class="col-sm-4 col-form-label">{{__('book.number_of_infant')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="noi_{{$value->product_id}}" class="form-control text-right" value="{{$value->unit_infant}}" onchange="calculatePrice('{{$value->product_id}}','noi_')" price="{{$value->public_infant}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.discounts')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="d_{{$value->product_id}}" class="form-control text-right" value="{{$value->discount}}" onchange="calculatePrice('{{$value->product_id}}','')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.total')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="t_{{$value->product_id}}" readonly class="form-control text-right" value="{{$value->total}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.vat')}}</label>
                                                                <div class="input-group col-sm-8">
                                                                    <div class="input-group-prepend"><div class="input-group-text">%
                                                                        </div>
                                                                    </div>
                                                                    <input type="number" name="v_{{$value->product_id}}" class="form-control text-right" value="{{$value->vat}}" onchange="calculatePrice('{{$value->product_id}}','')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">{{__('book.net_total')}}</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="nt_{{$value->product_id}}" readonly class="form-control text-right" value="{{$value->net}}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--<div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('book.search_product') }} </label>
                                    <select class="form-control" id="searchProduct"></select>
                                </div>
                            </div>--}}

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

        $(function () {
            $('.form-date').daterangepicker({
                "singleDatePicker": true
            });

        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
    <script src="{{ asset('js/backend/booking.js') }}"></script>
@endsection


