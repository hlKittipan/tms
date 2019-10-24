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
                    <div class="card-header">{{ __('product.add_periods') }}</div>

                    <div class="card-body">

                        <form class="" method="POST" id="main-form"
                              action="{{route('backend.product.period.store')}}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product_id}}">
                            <div class="form-row">
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
                                        <td><input type="checkbox" value="{{old('all')}}" name="all"></td>
                                        <td><input type="checkbox" value="{{old('sunday')}}" name="sunday"></td>
                                        <td><input type="checkbox" value="{{old('monday')}}" name="monday"></td>
                                        <td><input type="checkbox" value="{{old('tuesday')}}" name="tuesday"></td>
                                        <td><input type="checkbox" value="{{old('wednesday')}}" name="wednesday"></td>
                                        <td><input type="checkbox" value="{{old('thursday')}}" name="thursday"></td>
                                        <td><input type="checkbox" value="{{old('friday')}}" name="friday"></td>
                                        <td><input type="checkbox" value="{{old('saturday')}}" name="saturday"></td>
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

            var start = moment().subtract(29, 'days');
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


