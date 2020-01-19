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
                                            <img src="https://www.islandtourphuket.com/public/img/01.png"
                                                 class="d-block w-100"
                                                 alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="https://www.islandtourphuket.com/public/img/02.png"
                                                 class="d-block w-100"
                                                 alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="https://www.islandtourphuket.com/public/img/03.png"
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
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body"></div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

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
        });
    </script>
@endsection
