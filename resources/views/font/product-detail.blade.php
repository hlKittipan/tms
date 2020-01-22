@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container p-1">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$data->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                            class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{new_asset('/img/01.png')}}"
                                                 class="d-block w-100"
                                                 alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{new_asset('/img/02.png')}}"
                                                 class="d-block w-100"
                                                 alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{new_asset('/img/03.png')}}"
                                                 class="d-block w-100"
                                                 alt="...">
                                        </div>
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
                            <div class="col-4">
                                <div class="card" id="cardBook">
                                    <div class="card-header"><h4>ID : 998746156156</h4></div>
                                    <div class="card-body">
                                        <div>
                                            <div class="py-1">
                                                <div class="float-left">Adult</div>
                                                <div class="float-right price-final">300</div>
                                                <div class="float-right price-original">500</div>
                                            </div>
                                            <br>
                                            <div class="py-1">
                                                <div class="float-left">Child</div>
                                                <div class="float-right price-final">300</div>
                                                <div class="float-right price-original">500</div>
                                            </div>
                                            <br>
                                            <div class="py-1">
                                                <div class="float-left">Infant</div>
                                                <div class="float-right price-final">300</div>
                                                <div class="float-right price-original">500</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row text-center">
                                            <div class="col-12 py-2">
                                                <a href="#" type="button" class="btn btn-block btn-outline-primary">Book
                                                    now</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" type="button" class="btn btn-block btn-outline-danger">Call
                                                    book</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" type="button" class="btn btn-block btn-outline-success">Line
                                                    book</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cardBookBottom" class="card fixed">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="float-left">Adult</div>
                            <div class="float-right price-final">300</div>
                            <div class="float-right price-original">500</div>
                        </div>
                        <div class="col-4">
                            <div class="float-left">Child</div>
                            <div class="float-right price-final">300</div>
                            <div class="float-right price-original">500</div>
                        </div>
                        <div class="col-4">
                            <div class="float-left">Infant</div>
                            <div class="float-right price-final">300</div>
                            <div class="float-right price-original">500</div>
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

        });

    </script>
@endsection