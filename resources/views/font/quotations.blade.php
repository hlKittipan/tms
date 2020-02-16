@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <form class="" method="POST" id="main-form"
                      action="{{route('quotations.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$data->id}}">
                    <input type="hidden" name="period_id" value="{{$data->price[0]->id}}">
                    <input type="hidden" name="price_id" value="{{$data->price[0]->price_id}}">
                    <input type="hidden" name="s_price_id" value="{{$data->price[0]->s_price_id}}">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="btn-toolbar justify-content-between" role="toolbar"
                                 aria-label="Toolbar with button groups">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <h4>{{__('book.quotations')}} </h4>
                                </div>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="card-body pd-all-5">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <div>Product name : {{$data->name}} <br> Book Date : {{$data->book_date}}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <h4>Select pax</h4>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <div class="py-1">
                                                        <div class="float-left">Adult</div>
                                                        @if($data->price[0]->s_adult == null)
                                                            <div class="float-right">{{$data->price[0]->public_adult}}</div>
                                                        @else
                                                            <div class="float-right price-final">{{$data->price[0]->s_adult}}</div>
                                                            <div class="float-right price-original">{{$data->price[0]->public_adult}}</div>
                                                        @endif
                                                    </div>
                                                    <br>
                                                    <div class="py-1">
                                                        <div class="float-left">Child</div>
                                                        @if($data->price[0]->s_child == null)
                                                            <div class="float-right">{{$data->price[0]->public_child}}</div>
                                                        @else
                                                            <div class="float-right price-final">{{$data->price[0]->s_child}}</div>
                                                            <div class="float-right price-original">{{$data->price[0]->public_child}}</div>
                                                        @endif
                                                    </div>
                                                    <br>
                                                    <div class="py-1">
                                                        <div class="float-left">Infant</div>
                                                        @if($data->price[0]->s_infant == null)
                                                            <div class="float-right">{{$data->price[0]->public_infant}}</div>
                                                        @else
                                                            <div class="float-right price-final">{{$data->price[0]->s_infant}}</div>
                                                            <div class="float-right price-original">{{$data->price[0]->public_infant}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Number of Adult</label>
                                                    <div class="col-sm-8"><input type="number" name="noa_102" class="form-control text-right" value="0"
                                                                                 onchange="calculatePrice('{!! $data->id !!}','noa_')"
                                                                                 price="{{$data->price[0]->s_price_id != null ? $data->price[0]->s_adult : $data->price[0]->public_adult }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Number of Child</label>
                                                    <div class="col-sm-8"><input type="number" name="noc_102" class="form-control text-right" value="0"
                                                                                 onchange="calculatePrice('{!! $data->id !!}','noc_')"
                                                                                 price="{{$data->price[0]->s_price_id != null ? $data->price[0]->s_child : $data->price[0]->public_child }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Number of Infant</label>
                                                    <div class="col-sm-8"><input type="number" name="noi_102" class="form-control text-right" value="0"
                                                                                 onchange="calculatePrice('{!! $data->id !!}','noi_')"
                                                                                 price="{{$data->price[0]->s_price_id != null ? $data->price[0]->s_infant : $data->price[0]->public_infant }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Total</label>
                                                    <div class="col-sm-8"><input type="number" name="t_102"  class="form-control text-right"></div>
                                                </div>
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Vat</label>
                                                    <div class="input-group col-sm-8">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="number" name="v_102" class="form-control text-right" value="7"
                                                               onchange="calculatePrice('{!! $data->id !!}','')" readonly="">
                                                    </div>
                                                </div>
                                                <div class="form-group row"><label class="col-sm-4 col-form-label">Net Total</label>
                                                    <div class="col-sm-8"><input type="number" name="nt_102" readonly="" class="form-control text-right"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container py-3 hide" id="panel_client">
                                <div class="row">
                                    <div class="col-md-12 shadow-sm">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-md-12"><h4>Customer name</h4>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row"><label class="col-sm-2 col-form-label">First name</label>
                                                            <div class="col-sm-4"><input type="text" name="first_name" placeholder="First name" class="form-control"></div>
                                                            <label class="col-sm-2 col-form-label">Last name</label>
                                                            <div class="col-sm-4"><input type="text" name="last_name" placeholder="Last name" class="form-control"></div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-sm-2 col-form-label">E-mail</label>
                                                            <div class="col-sm-4"><input type="email" name="email" class="form-control"></div>
                                                            <label class="col-sm-2 col-form-label">Upload Passport</label>
                                                            <div class="col-sm-4"><input type="file" name="passport" multiple="multiple" accept="image/*" class="form-control-file">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-sm-2 col-form-label">Hotel name</label>
                                                            <div class="col-sm-10"><input type="text" name="hotel_name" class="form-control"></div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-sm-2 col-form-label">Hotel Tel.</label>
                                                            <div class="col-sm-5"><input type="text" name="hotel_tel" class="form-control"></div>
                                                            <label class="col-sm-2 col-form-label">Room number</label>
                                                            <div class="col-sm-3"><input type="text" name="room_number" class="form-control"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-toolbar justify-content-between" role="toolbar"
                                     aria-label="Toolbar with button groups">
                                    <div class="btn-group" role="group" aria-label="First group">
                                    </div>
                                    <button type="button" class="btn btn-outline-success" id="next" onclick="checkAvailable()">Next</button>
                                    <button type="submit" class="btn btn-outline-success hide" id="store">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var available_total = '{{$data->unit_total}}';
        document.addEventListener('DOMContentLoaded', function () {

        });

        function calculatePrice(product_id, input_name) {
            var noa = parseInt($('input[name="noa_' + product_id + '"]').val());
            var noc = parseInt($('input[name="noc_' + product_id + '"]').val());
            var noi = parseInt($('input[name="noi_' + product_id + '"]').val());
            var total_pax = (noa + noc + noi) + parseInt(available_total);
            var vat = parseInt($('input[name="v_' + product_id + '"]').val());
            var t = 0;
            var nt = 0;
            var public_adult = parseInt($('input[name="noa_' + product_id + '"]').attr('price'));
            var public_child = parseInt($('input[name="noc_' + product_id + '"]').attr('price'));
            var public_infant = parseInt($('input[name="noi_' + product_id + '"]').attr('price'));
            var number_of_pax = parseInt('{{$data->number_of_pax}}');

            if (!$.isNumeric(noa) || !$.isNumeric(noc) || !$.isNumeric(noi)) {
                return false
            }

            if (total_pax > number_of_pax) {
                $("#alertMessageBody").html('<p>The number of passengers exceeds the maximum number of products.</p>');
                $('#alertMessage').modal('show');
                resetValuePax(input_name + product_id);
            } else {
                t = ((noa * public_adult) + (noc * public_child) + (noi * public_infant));
                nt = (t + (t * vat / 100));
                $('input[name="t_' + product_id + '"]').val(t.toFixed(2));
                $('input[name="nt_' + product_id + '"]').val(nt.toFixed(2));
            }

        }

        function resetValuePax(input_name) {
            $('input[name="' + input_name + '"]').val(0)
        }

        function checkAvailable() {
            var product_id = '{{$data->id}}';
            var noa = parseInt($('input[name="noa_' + product_id + '"]').val());
            var noc = parseInt($('input[name="noc_' + product_id + '"]').val());
            var noi = parseInt($('input[name="noi_' + product_id + '"]').val());
            var total_pax = (noa + noc + noi) + parseInt(available_total);

            $.ajax({
                type: 'get',
                url: '{{route('available')}}',
                data: {
                    product_id: '{{$data->id}}',
                    period_id: '{{$data->price[0]->id}}',
                    price_id: '{{$data->price[0]->price_id}}',
                    s_price_id: '{{$data->price[0]->s_price_id}}',
                    total_pax: total_pax,
                    book_date: '{{$data->book_date}}'
                },
                success: function (data) {
                    if (data) {
                        $("#panel_client").show();
                        $("#store").show();
                        $("#next").hide();
                        $('input[name="noa_' + product_id + '"]').prop("readonly", true);
                        $('input[name="noc_' + product_id + '"]').prop("readonly", true);
                        $('input[name="noi_' + product_id + '"]').prop("readonly", true);
                        $('input[name="t_' + product_id + '"]').prop("readonly", true);
                    } else {
                        alert(data);
                    }
                }
            });
        }
    </script>
@endsection
