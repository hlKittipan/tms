@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('product.edit_periods') }}</div>

                    <div class="card-body">

                        <form class="" method="POST" id="main-form"
                              action="{{route('backend.product.period.update')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$period->product_id}}">
                            <input type="hidden" name="period_id" value="{{$period->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('product.start_date') }}</label>
                                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" name="date_start" value="{{\Carbon\Carbon::parse($period->date_start)->format('Y-m-d')}}">
                                    <input type="hidden" name="date_end" value="{{$period->date_end}}">
                                    <input type="hidden" name="current_date_start" value="{{\Carbon\Carbon::parse($period->date_start)->format('Y-m-d')}}">
                                    <input type="hidden" name="current_date_end" value="{{$period->date_end}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td colspan="8">{{__('product.available_of_days')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{__('product.all')}}</td>
                                        <td>{{__('product.sunday')}}</td>
                                        <td>{{__('product.monday')}}</td>
                                        <td>{{__('product.tuesday')}}</td>
                                        <td>{{__('product.wednesday')}}</td>
                                        <td>{{__('product.thursday')}}</td>
                                        <td>{{__('product.friday')}}</td>
                                        <td>{{__('product.saturday')}}</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="all"></td>
                                        <td><input type="checkbox" {{$period->sun == 1 ? " checked" : ""}} name="sun"></td>
                                        <td><input type="checkbox" {{$period->mon == 1 ? " checked" : ""}} name="mon"></td>
                                        <td><input type="checkbox" {{$period->tue == 1 ? " checked" : ""}} name="tue"></td>
                                        <td><input type="checkbox" {{$period->wed == 1 ? " checked" : ""}} name="wed"></td>
                                        <td><input type="checkbox" {{$period->thu == 1 ? " checked" : ""}} name="thu"></td>
                                        <td><input type="checkbox" {{$period->fri == 1 ? " checked" : ""}} name="fri"></td>
                                        <td><input type="checkbox" {{$period->sat == 1 ? " checked" : ""}} name="sat"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group">
                                <label>{{ __('product.remark') }}</label>
                                <textarea class="form-control" name="remark" placeholder="Required"
                                          rows="3">{{ $period->remark }}</textarea>
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

            var start = moment("{{$period->date_start}}");
            var end = moment("{{$period->date_end}}");

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


