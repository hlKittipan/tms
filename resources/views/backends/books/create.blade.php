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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('book.search_product') }}</label>
                                    <select class="form-control" id="searchProduct"></select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4>@lang('book.product_list')</h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">Id : 1 , Product Name : Phi Phi  <span class="float-right">Available 0/30</span></div>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label><b>{{__('book.adult')}} : </b> 100</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><b>{{__('book.child')}} : </b> 50</label>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label><b>{{__('book.infant')}} : </b> 10</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form action="" method="post">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Number of pax</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Password</label>
                                                                <div class="col-sm-8">
                                                                    <input type="num" class="form-control">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="8">{{__('book.product_list')}}</th>
                                    </tr>
                                    <tr>
                                        <th>{{__('product.id')}}</th>
                                        <th>{{__('product.name')}}</th>
                                        <th>{{__('book.available')}}</th>
                                        <th>{{__('book.adult')}}</th>
                                        <th>{{__('book.child')}}</th>
                                        <th>{{__('book.infant')}}</th>
                                        <th>{{__('setup.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_body"></tbody>
                                </table>
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


