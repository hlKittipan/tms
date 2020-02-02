@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Search</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Province</h5>
                                                <div class="form-group px-3">

                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Phuket</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Phangnga</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Krabi</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Province</h5>
                                                <div class="form-group px-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Phuket</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Phangnga</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Krabi</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src="{{new_asset('img/03.png')}}" class="card-img img-fluid" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Card title</h5>
                                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cardBookBottom" class="card fixed">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="float-left">Adult</div>

                        </div>
                        <div class="col-md-4">
                            <div class="float-left">Child</div>

                        </div>
                        <div class="col-md-4">
                            <div class="float-left">Infant</div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <a href="#" type="button" class="btn btn-sm btn-block btn-outline-primary">Book now</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" type="button" class="btn btn-sm btn-block btn-outline-danger">Call book</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" type="button" class="btn btn-sm btn-block btn-outline-success">Line book</a>
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
