@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="card shadow">
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
                                <div class="col-md-8 shadow-sm">
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
                                                    <img src="{{$v->src}}"
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
                                    <div class="card shadow" id="cardBook">
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
                        <div class="container py-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <nav id="productDetailTab" class="navbar nav-sticky">
                                        <ul class="nav justify-content-center nav-pills nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link" id="overview-tab" href="#overview" onclick="smoothTo('overview')">Overview</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="itinerary-tab" href="#itinerary" onclick="smoothTo('itinerary')">Itinerary</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="includes-tab" href="#includes" onclick="smoothTo('includes')">Include</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="excludes-tab" href="#excludes" onclick="smoothTo('excludes')">Exclude</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="conditions-tab" href="#conditions" onclick="smoothTo('conditions')">Condition</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="remark-tab" href="#remark" onclick="smoothTo('remark')">Remark</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div data-spy="scroll" data-target="#productDetailTab" data-offset="0">
                                        <h4 id="overview">{{ __('product.overview') }}</h4>
                                        <div class="px-3">{!! $data->overview !!}</div>
                                        <h4 id="itinerary">{{ __('product.itinerary') }}</h4>
                                        <div class="px-3">{!! $data->itinerary !!}</div>
                                        <h4 id="includes">{{ __('product.includes') }}</h4>
                                        <div class="px-3">{!! $data->includes !!}</div>
                                        <h4 id="excludes">{{ __('product.excludes') }}</h4>
                                        <div class="px-3">{!! $data->excludes !!}</div>
                                        <h4 id="conditions">{{ __('product.conditions') }}</h4>
                                        <div class="px-3">{!! $data->conditions !!}</div>
                                        <h4 id="remark">{{ __('product.remark') }}</h4>
                                        <div class="px-3">{!! $data->remark !!}</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div id='calendar'></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="cardBookBottom" class="card fixed hide">
                <div class="container">
                    <div class="card-body pd-all-5">
                        <div class="row text-center">
                            <div class="col-md-4 col-sm-4">
                                <div class="float-left">Adult</div>
                                @if($data->periods[0]->s_adult == null)
                                    <div class="float-right">{{$data->periods[0]->public_adult}}</div>
                                @else
                                    <div class="float-right price-final">{{$data->periods[0]->s_adult}}</div>
                                    <div class="float-right price-original">{{$data->periods[0]->public_adult}}</div>
                                @endif
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="float-left">Child</div>
                                @if($data->periods[0]->s_child == null)
                                    <div class="float-right">{{$data->periods[0]->public_child}}</div>
                                @else
                                    <div class="float-right price-final">{{$data->periods[0]->s_child}}</div>
                                    <div class="float-right price-original">{{$data->periods[0]->public_child}}</div>
                                @endif
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="float-left">Infant</div>
                                @if($data->periods[0]->s_infant == null)
                                    <div class="float-right">{{$data->periods[0]->public_infant}}</div>
                                @else
                                    <div class="float-right price-final">{{$data->periods[0]->s_infant}}</div>
                                    <div class="float-right price-original">{{$data->periods[0]->public_infant}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row text-center">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <th>
                                        <a href="#" type="button" class="btn btn-sm btn-block btn-outline-primary">Book now</a>
                                    </th>
                                    <th>
                                        <a href="#" type="button" class="btn btn-sm btn-block btn-outline-danger">Call book</a>
                                    </th>
                                    <th>
                                        <a href="#" type="button" class="btn btn-sm btn-block btn-outline-success">WeChat book</a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [dayGridPlugin, interactionPlugin],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                selectable: true,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2020-01-01',
                    },
                    {
                        title: 'Long Event',
                        start: '2018-01-07',
                        end: '2020-01-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2020-01-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2020-01-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2018-01-11',
                        end: '2020-01-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-01-12T10:30:00',
                        end: '2020-01-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2020-01-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-01-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2020-01-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2020-01-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2020-01-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2020-01-28'
                    }
                ],
                dateClick: function (info) {
                    alert('Clicked on: ' + info.dateStr);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('Current view: ' + info.view.type);
                    // change the day's background color just for fun
                    info.dayEl.style.backgroundColor = 'red';
                }
            });

            calendar.render();

            var stickyOffset = $('#cardBook').offset().top;

            $(window).scroll(function () {
                var sticky = $('#cardBook'),
                    scroll = $(window).scrollTop();
                if (scroll >= stickyOffset) {
                    //sticky.addClass('fixed');
                    $("#cardBookBottom").show(300);
                    $("#cardBook").hide();
                } else {
                    //sticky.removeClass('fixed');
                    $("#cardBook").show(300);
                    $("#cardBookBottom").hide();
                }
            });

            $('body').scrollspy({ target: '#productDetailTab' })
        });
        function smoothTo(f_id){
            $('html, body').animate({
                scrollTop: $("#"+f_id).offset().top
            }, 500);
        }
    </script>
@endsection
