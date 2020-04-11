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
                    <div class="card-header">{{ __('product.province_management') }}</div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <form class="was-validated needs-validation" method="GET"
                                  action="{{ route('backend.report') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <input type="text" name="dates" class="form-control col-sm-4" required/>
                                    <input type="hidden" name="reportType" value="{{$type}}">
                                    <button type="submit" class="btn btn-primary col-sm-2">{{ __('product.search') }}</button>
                                    <button type="reset" class="btn btn-danger col-sm-2">{{ __('auth.reset') }}</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        @isset($result)
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product name</th>
                                        <th scope="col">January</th>
                                        <th scope="col">February</th>
                                        <th scope="col">March</th>
                                        <th scope="col">April</th>
                                        <th scope="col">May</th>
                                        <th scope="col">June</th>
                                        <th scope="col">July</th>
                                        <th scope="col">August</th>
                                        <th scope="col">September</th>
                                        <th scope="col">October</th>
                                        <th scope="col">November</th>
                                        <th scope="col">December</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key => $value)
                                        @if(property_exists($value,"data"))
                                            @foreach($value->data as $k => $v)
                                                <tr>
                                                    @if($loop->first)
                                                        <th scope="row" rowspan="{{count((array)$value->data)}}" class="align-middle">{{$key}}</th>
                                                    @endif
                                                    <td>{{$v->name}}</td>
                                                    <td>{!! $v->{"01"} !!}</td>
                                                    <td>{!! $v->{"02"} !!}</td>
                                                    <td>{!! $v->{"03"} !!}</td>
                                                    <td>{!! $v->{"04"} !!}</td>
                                                    <td>{!! $v->{"05"} !!}</td>
                                                    <td>{!! $v->{"06"} !!}</td>
                                                    <td>{!! $v->{"07"} !!}</td>
                                                    <td>{!! $v->{"08"} !!}</td>
                                                    <td>{!! $v->{"09"} !!}</td>
                                                    <td>{!! $v->{"10"} !!}</td>
                                                    <td>{!! $v->{"11"} !!}</td>
                                                    <td>{!! $v->{"12"} !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            var string = '{{request()->get('dates')}}', start = moment.now(), end = moment.now();
            var dates = string.split(' - ');
            if (dates[0] != "") {
                start = dates[0];
                end = dates[1];
            }
            $('input[name="dates"]').daterangepicker({
                "showWeekNumbers": true,
                "showISOWeekNumbers": true,
                "startDate": start,
                "endDate": end,
                ranges: {
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
                    'Last Year': [moment().subtract(1, 'year').startOf('month'), moment().subtract(1, 'year').endOf('month')],
                    'Next Year': [moment().add(1, 'year').startOf('month'), moment().add(1, 'year').endOf('month')],
                },
                "alwaysShowCalendars": true,
            }, function (start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
        })
    </script>
@endsection
