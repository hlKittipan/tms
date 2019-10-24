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
                    <div class="card-header">{{ __('product.add_prices') }}</div>

                    <div class="card-body">

                        <form method="POST" id="main-form"
                              action="{{route('backend.product.price.store')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product_id}}">
                            <input type="hidden" name="period_id" value="{{$period_id}}">
                            <div class="form-row" style="display: none">
                                <div class="form-group col-md-6">
                                    <label>{{ __('product.start_date') }}</label>
                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" name="date_start">
                                    <input type="hidden" name="date_end">

                                </div>
                            </div>

                            <div class="form-group table-responsive">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <th width="16%">{{__('product.cost_adult')}}</th>
                                        <th width="16%">{{__('product.cost_child')}}</th>
                                        <th width="16%">{{__('product.cost_infant')}}</th>
                                        <th width="16%">{{__('product.public_adult')}}</th>
                                        <th width="16%">{{__('product.public_child')}}</th>
                                        <th width="16%">{{__('product.public_infant')}}</th>
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="form-control" value="{{old('cost_adult')}}" name="cost_adult" required></td>
                                        <td><input type="number" class="form-control" value="{{old('cost_child')}}" name="cost_child" required></td>
                                        <td><input type="number" class="form-control" value="{{old('cost_infant')}}" name="cost_infant" required></td>
                                        <td><input type="number" class="form-control" value="{{old('public_adult')}}" name="public_adult" required></td>
                                        <td><input type="number" class="form-control" value="{{old('public_child')}}" name="public_child" required></td>
                                        <td><input type="number" class="form-control" value="{{old('public_infant')}}" name="public_infant" required></td>
                                    </tr>
                                </table>
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
        $(function() {

            var start = moment().subtract(1, 'year');
            var end = moment();

            function cb(start, end) {
                $('input[name="date_start"]').val(start.format('YYYY-MM-DD'));
                $('input[name="date_end"]').val(end.format('YYYY-MM-DD'));
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'Next Year': [moment().add(1, 'year').startOf('year'), moment().add(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


