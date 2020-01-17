@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <section class="imageSlider">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.islandtourphuket.com/public/img/01.png" class="d-block w-100"
                                 alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.islandtourphuket.com/public/img/02.png" class="d-block w-100"
                                 alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.islandtourphuket.com/public/img/03.png" class="d-block w-100"
                                 alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
            <section class="searchBox">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10 py-2 border rounded my-4">
                            <h3 class="text-center text-title">Search tour</h3>
                            <form>
                                <div class="form-group row justify-content-lg-center">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="Search your tour">
                                    </div>
                                    <div class="col-sm-1 text-center search-display-max">
                                        <button type="submit" class="btn search-outline-blue"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-lg-center">
                                    <label class="col-sm-1 col-form-label text-lg-right">Country</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="country">
                                            <option>Select Country</option>
                                            <option>Phuket</option>
                                            <option>Pangnga</option>
                                            <option>Krabi</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label text-lg-right">Adult</label>
                                    <div class="col-sm-1">
                                        <input type="number" name="adult" class="form-control">
                                    </div>
                                    <label class="col-sm-1 col-form-label text-lg-right">Child</label>
                                    <div class="col-sm-1">
                                        <input type="number" name="child" class="form-control">
                                    </div>
                                    <label class="col-sm-1 col-form-label text-lg-right">Month</label>
                                    <div class="col-sm-3">
                                        <input type="month" name="month" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center search-display-min">
                                    <button type="submit" class="btn search-outline-blue"><i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="tourPromotion bg-gray-light-1 ">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 my-4 ">
                            <h3 class="text-center pb-2 text-title">Tour promotions</h3>
                            <div class="row justify-content-md-center row-cols-1 row-cols-md-3">
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="https://www.islandtourphuket.com/public/img/640x480.png"
                                             class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="card-text">
                                                <h5 class="float-left"><b>Phi Phi Island</b></h5>
                                                <h6 class="float-right">Id : 12001</h6>
                                                <br><br>
                                                <p>This is a wider card with supporting text below as a natural lead-in
                                                    to
                                                    additional content. This content is a little bit longer.</p>
                                                <hr>
                                                <div class="py-1">
                                                    <div class="float-left">Adult</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Child</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Infant</div>
                                                    <div class="float-right">0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-outline-danger">See detail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="https://www.islandtourphuket.com/public/img/640x480.png"
                                             class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="card-text">
                                                <h5 class="float-left"><b>Phi Phi Island</b></h5>
                                                <h6 class="float-right">Id : 12001</h6>
                                                <br><br>
                                                <p>This is a wider card with supporting text below as a natural lead-in
                                                    to
                                                    additional content. This content is a little bit longer.</p>
                                                <hr>
                                                <div class="py-1">
                                                    <div class="float-left">Adult</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Child</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Infant</div>
                                                    <div class="float-right">0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-outline-danger">See detail</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="https://www.islandtourphuket.com/public/img/640x480.png"
                                             class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="card-text">
                                                <h5 class="float-left"><b>Phi Phi Island</b></h5>
                                                <h6 class="float-right">Id : 12001</h6>
                                                <br><br>
                                                <p>This is a wider card with supporting text below as a natural lead-in
                                                    to
                                                    additional content. This content is a little bit longer.</p>
                                                <hr>
                                                <div class="py-1">
                                                    <div class="float-left">Adult</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Child</div>
                                                    <div class="float-right price-final">100</div>
                                                    <div class="float-right price-original">200</div>
                                                </div>
                                                <br>
                                                <div class="py-1">
                                                    <div class="float-left">Infant</div>
                                                    <div class="float-right">0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-outline-danger">See detail</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if(isset($topSales->data) )
                <p>dlksjglksgajlkdsjlk</p>
            @else
            <section class="topSales">
                <div class="container">
                    <div class="row justify-content-lg-center py-4">
                        <div class="col-md-12">
                            <div class="text-title">
                                <h3 class="text-center text-title">Top sales 2019</h3>
                            </div>
                            <div class="p-2">
                                <!-- swiper -->
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($topSales as $key=>$value)
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="{{$value->src}}"
                                                     class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <div class="card-text">
                                                        <h5 class="float-left"><b>{{$value->name}}</b></h5>
                                                        <h6 class="float-right">Id : {{$value->code}}</h6>
                                                        <br><br>
                                                        <p>{{$value->overview}}</p>
                                                        <hr>
                                                        <div>
                                                            <div class="float-left">Adult</div>
                                                            <div class="float-right">{{$value->public_adult}}</div>
                                                            <br>
                                                            <div class="float-left">Child</div>
                                                            <div class="float-right">{{$value->public_child}}</div>
                                                            <br>
                                                            <div class="float-left">Infant</div>
                                                            <div class="float-right">{{$value->public_infant}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button type="button" class="btn btn-outline-danger">See detail
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                loopFillGroupWithBlank: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 40
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                }
            });
        });
    </script>
@endsection
