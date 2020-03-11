@extends('layouts.app')
@section('title', 'Search Tour '. session('search') )

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('search')}}" method="GET">
                            @csrf
                            <input type="hidden" value="{!! session('month') !!}" name="month">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"><h5>{{ __('product.search') }}</h5></label>
                                            <div class="col-sm-6">
                                                <input name="search" class="form-control" value="{!! session('search') !!}"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <form action="">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <h5 class="card-title">Province</h5>
                                                        <div class="form-group px-3">
                                                            @isset($data->province)
                                                                @foreach($data->province as $k => $v)
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" name="country[]"
                                                                               value="{!! $k !!}" @foreach(session('country') as $list) {!! $k == $list ? 'checked' : '' !!} @endforeach>
                                                                        <label class="form-check-label" for="exampleCheck1">{!! $v !!}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endisset
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <button type="submit" class="btn search-outline-blue"><i class="fa fa-search"></i> Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                @isset($data->result)
                                                    @foreach($data->result as $key=>$value)
                                                        <div class="col-md-4 p-2">
                                                            <div class="card"><img src="{!! new_asset($value->src) !!}" alt="..." class="card-img-top">
                                                                <div class="card-body">
                                                                    <div class="card-text"><h5 class="float-left"><b>{!! $value->name !!}</b></h5> <h6
                                                                            class="float-right">Id : {!! $value->code !!}</h6> <br><br>
                                                                        <p>{!! $value->overview !!}</p>
                                                                        <hr>
                                                                        <div>
                                                                            <div class="py-1">
                                                                                <div class="float-left">Adult</div>
                                                                                @if($value->s_adult == null)
                                                                                    <div class="float-right">{{$value->public_adult}}</div>
                                                                                @else
                                                                                    <div class="float-right price-final">{{$value->s_adult}}</div>
                                                                                    <div class="float-right price-original">{{$value->public_adult}}</div>
                                                                                @endif
                                                                            </div>
                                                                            <br>
                                                                            <div class="py-1">
                                                                                <div class="float-left">Child</div>
                                                                                @if($value->s_child == null)
                                                                                    <div class="float-right">{{$value->public_child}}</div>
                                                                                @else
                                                                                    <div class="float-right price-final">{{$value->s_child}}</div>
                                                                                    <div class="float-right price-original">{{$value->public_child}}</div>
                                                                                @endif
                                                                            </div>
                                                                            <br>
                                                                            <div class="py-1">
                                                                                <div class="float-left">Infant</div>
                                                                                @if($value->s_infant == null)
                                                                                    <div class="float-right">{{$value->public_infant}}</div>
                                                                                @else
                                                                                    <div class="float-right price-final">{{$value->s_infant}}</div>
                                                                                    <div class="float-right price-original">{{$value->public_infant}}</div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer text-center">
                                                                    <a href="{{route('product',$value->id)}}" type="button" class="btn btn-outline-danger">See
                                                                        detail
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endisset
                                            </div>
                                        </div>
                                        {!! $data->result->render() !!}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="cardBookBottom" class="card fixed hide">
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
