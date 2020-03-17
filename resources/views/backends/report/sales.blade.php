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
                                  action="{{ route('backend.report.sales') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <input type="text" name="dates" class="form-control col-sm-4" required/>
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
            $('input[name="dates"]').daterangepicker({
                "showWeekNumbers": true,
                "showISOWeekNumbers": true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "alwaysShowCalendars": true,
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '2019',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: 'rgb(59,247,16)',
                        backgroundColor: 'rgb(59,247,16,0.6)',
                        pointBorderWidth: 3,
                    },
                    {
                        label: '2020',
                        data: [5, 9, 12, 7, 5, 2],
                        borderColor: 'rgb(17,149,247)',
                        backgroundColor: 'rgba(17,149,247,0.6)',
                        pointBorderWidth: 3,
                    }]
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
