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
                        <div class="col-md-12">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            var label = {!! $label !!};
            var datasets = {!! $datasets !!};
            $('input[name="dates"]').daterangepicker({
                "showWeekNumbers": true,
                "showISOWeekNumbers": true,
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

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })
    </script>
@endsection
