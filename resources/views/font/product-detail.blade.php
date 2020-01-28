@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="card">
                    <div class="card-header">

                        <div class="btn-toolbar justify-content-between" role="toolbar"
                             aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <h4>{{$data->name}}</h4>
                            </div>
                            <h4>ID : {{$data->code}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach($data->images as $k => $v)
                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$k}}"
                                                    class="@if ($v == reset($data->images)) active @endif"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach($data->images as $k => $v)
                                                <div
                                                    class="carousel-item @if ($v == reset($data->images)) active @endif">
                                                    <img src="{{new_asset($v->src)}}"
                                                         class="d-block w-100"
                                                         alt="{{$v->alt}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" id="cardBook">
                                        <div class="card-header"><h4>ID : {{$data->code}}</h4></div>
                                        <div class="card-body">
                                            <div>
                                                <div class="py-1">
                                                    <div class="float-left">Adult</div>
                                                    @if($data->periods[0]->s_adult == null)
                                                        <div class="float-right">{{$data->periods[0]->public_adult}}</div>
                                                    @else
                                                        <div class="float-right price-final">{{$data->periods[0]->s_adult}}</div>
                                                        <div class="float-right price-original">{{$data->periods[0]->public_adult}}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Child</div>
                                                    @if($data->periods[0]->s_child == null)
                                                        <div class="float-right">{{$data->periods[0]->public_child}}</div>
                                                    @else
                                                        <div class="float-right price-final">{{$data->periods[0]->s_child}}</div>
                                                        <div class="float-right price-original">{{$data->periods[0]->public_child}}</div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Infant</div>
                                                    @if($data->periods[0]->s_infant == null)
                                                        <div class="float-right">{{$data->periods[0]->public_infant}}</div>
                                                    @else
                                                        <div class="float-right price-final">{{$data->periods[0]->s_infant}}</div>
                                                        <div class="float-right price-original">{{$data->periods[0]->public_infant}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row text-center">
                                                <div class="col-md-12 py-2">
                                                    <a href="#" type="button" class="btn btn-block btn-outline-primary">Book
                                                        now</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="#" type="button" class="btn btn-block btn-outline-danger">Call
                                                        book</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="#" type="button" class="btn btn-block btn-outline-success">Line
                                                        book</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <ul class="nav nav-tabs" id="productDetailTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview"
                                               aria-selected="true">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="itinerary-tab" data-toggle="tab" href="#itinerary" role="tab" aria-controls="itinerary"
                                               aria-selected="false">Itinerary</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="include-tab" data-toggle="tab" href="#include" role="tab" aria-controls="include"
                                               aria-selected="false">Include</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="exclude-tab" data-toggle="tab" href="#exclude" role="tab" aria-controls="exclude"
                                               aria-selected="false">Exclude</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="condition-tab" data-toggle="tab" href="#condition" role="tab" aria-controls="condition"
                                               aria-selected="false">Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="remark-tab" data-toggle="tab" href="#remark" role="tab" aria-controls="remark" aria-selected="false">Remark</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="productDetailContent">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                             aria-labelledby="overview-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Overview</h4>
                                                    <p>{{$data->overview}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="itinerary" role="tabpanel"
                                             aria-labelledby="itinerary-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Itinerary</h4>
                                                    <p>{{$data->itinerary}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="include" role="tabpanel"
                                             aria-labelledby="include-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Include</h4>
                                                    <p>{{$data->includes}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="exclude" role="tabpanel"
                                             aria-labelledby="exclude-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Exclude</h4>
                                                    <p>{{$data->excludes}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="condition" role="tabpanel"
                                             aria-labelledby="condition-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Condition</h4>
                                                    <p>{{$data->conditions}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="remark" role="tabpanel"
                                             aria-labelledby="remark-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Remark</h4>
                                                    <p>{{$data->remark}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cardBookBottom" class="card fixed">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="float-left">Adult</div>
                            @if($data->periods[0]->s_adult == null)
                                <div class="float-right">{{$data->periods[0]->public_adult}}</div>
                            @else
                                <div class="float-right price-final">{{$data->periods[0]->s_adult}}</div>
                                <div class="float-right price-original">{{$data->periods[0]->public_adult}}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <div class="float-left">Child</div>
                            @if($data->periods[0]->s_child == null)
                                <div class="float-right">{{$data->periods[0]->public_child}}</div>
                            @else
                                <div class="float-right price-final">{{$data->periods[0]->s_child}}</div>
                                <div class="float-right price-original">{{$data->periods[0]->public_child}}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <div class="float-left">Infant</div>
                            @if($data->periods[0]->s_infant == null)
                                <div class="float-right">{{$data->periods[0]->public_infant}}</div>
                            @else
                                <div class="float-right price-final">{{$data->periods[0]->s_infant}}</div>
                                <div class="float-right price-original">{{$data->periods[0]->public_infant}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-4">
                            <a href="#" type="button" class="btn btn-block btn-outline-primary">Book now</a>
                        </div>
                        <div class="col-4">
                            <a href="#" type="button" class="btn btn-block btn-outline-danger">Call book</a>
                        </div>
                        <div class="col-4">
                            <a href="#" type="button" class="btn btn-block btn-outline-success">Line book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function () {

            var stickyOffset = $('#cardBook').offset().top;
            $("#cardBookBottom").hide();

            $(window).scroll(function () {
                var sticky = $('#cardBook'),
                    scroll = $(window).scrollTop();
                if (scroll >= stickyOffset) {
                    //sticky.addClass('fixed');
                    $("#cardBookBottom").show();
                    $("#cardBook").hide();
                } else {
                    //sticky.removeClass('fixed');
                    $("#cardBook").show();
                    $("#cardBookBottom").hide();
                }
            });

            var calendarEl = $('#calendar');

            var calendar = new Calender(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                defaultDate: '2018-01-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2018-01-01',
                    },
                    {
                        title: 'Long Event',
                        start: '2018-01-07',
                        end: '2018-01-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2018-01-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2018-01-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2018-01-11',
                        end: '2018-01-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2018-01-12T10:30:00',
                        end: '2018-01-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2018-01-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2018-01-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2018-01-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2018-01-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2018-01-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2018-01-28'
                    }
                ]
            });

            calendar.render();

        });

    </script>
@endsection
