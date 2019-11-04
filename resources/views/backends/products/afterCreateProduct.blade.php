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
                    <div class="card-header">@lang('product.information')</div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.product')</h4>
                                <hr>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>@lang('product.id') : </b> {{ $product->id }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>@lang('product.name') : </b> {{$product->name}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.prices')</h4>
                                <hr>
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <a href="{{route('backend.product.period.create',$product->id)}}"
                                   class="btn btn-success">@lang('product.add_periods')</a>
                            </div>
                            <div class="form-group col-md-12" id="panel_periods">
                                <div class="card">
                                    <h5 class="card-header">{{__('product.period_lists')}}</h5>
                                    <div class="card-body">
                                        {{--period table--}}
                                        @isset($period)
                                            @foreach($period as $key => $value)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="float-md-left">
                                                            <b> {{__('product.date')}} : </b>{{\Carbon\Carbon::parse($value->date_start)->format('F jS, Y')}} to {{\Carbon\Carbon::parse($value->date_end)->format('F jS, Y')}}
                                                             @if(\Carbon\Carbon::parse($value->date_end) < \Carbon\Carbon::today() ) <span class="badge badge-pill badge-danger">Expire</span> @else <span class="badge badge-pill badge-success">Active</span> @endif
                                                        </div>
                                                        <div class="float-md-right">
                                                            <a href="{{route('backend.product.price.create',['product_id'=>$product->id,'period_id'=>$value->id])}}"
                                                               class="btn btn-success">@lang('product.add_prices')</a>
                                                            <a href="{{route('backend.product.period.edit',$value->id)}}"
                                                               class="btn btn-success " data-toggle="tooltip"
                                                               data-placement="top" title="Edit"><i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{route('backend.product.period.create',$value->id)}}"
                                                               class="btn btn-success" data-toggle="tooltip"
                                                               data-placement="top" title="Copy"><i class="far fa-copy"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 table-responsive">
                                                                <table class="table table-hover table-sm text-center">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>{{__('product.sunday')}}</td>
                                                                        <td>{{__('product.monday')}}</td>
                                                                        <td>{{__('product.tuesday')}}</td>
                                                                        <td>{{__('product.wednesday')}}</td>
                                                                        <td>{{__('product.thursday')}}</td>
                                                                        <td>{{__('product.friday')}}</td>
                                                                        <td>{{__('product.saturday')}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><i class="fas {{ $value->sun === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->mon === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->tue === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->wed === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->thu === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->fri === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                        <td><i class="fas {{ $value->sat === 1 ? "fa-check-circle text-success" : "fa-times-circle text-danger" }}"></i></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>{{__('product.remark')}}</b></td>
                                                                        <td colspan="7">{{$value->remark}}
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table
                                                                    class="table table-hover table-sm table-bordered text-center">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>{{__('product.cost_adult')}}</td>
                                                                        <td>{{__('product.cost_child')}}</td>
                                                                        <td>{{__('product.cost_infant')}}</td>
                                                                        <td>{{__('product.public_adult')}}</td>
                                                                        <td>{{__('product.public_child')}}</td>
                                                                        <td>{{__('product.public_infant')}}</td>
                                                                        <td>{{__('setup.action')}}</td>
                                                                    </tr>
                                                                    @foreach($value->price as $k => $v)
                                                                    <tr>
                                                                        <td>{{number_format($v->cost_adult,2)}}</td>
                                                                        <td>{{number_format($v->cost_child,2)}}</td>
                                                                        <td>{{number_format($v->cost_infant,2)}}</td>
                                                                        <td>{{number_format($v->public_adult,2)}}</td>
                                                                        <td>{{number_format($v->public_child,2)}}</td>
                                                                        <td>{{number_format($v->public_infant,2)}}</td>
                                                                        <td>
                                                                            <a href="{{route('backend.product.period.create',$v->id)}}"
                                                                               class="btn btn-success"  data-toggle="tooltip"
                                                                               data-placement="top" title="Copy"><i class="far fa-copy"></i></a>
                                                                            <a href="{{route('backend.product.period.create',$v->id)}}"
                                                                               class="btn btn-success disabled" data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="Edit"><i class="fas fa-edit"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end period lists--}}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>@lang('product.images')</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form class="was-validated needs-validation" method="POST"
                                      action="{{route('backend.product.image.store')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    @csrf
                                    <div class="form-group">
                                        <label>@lang('product.gallery')</label>
                                        <input type="file" class="form-control-file" name="gallery[]" multiple
                                               accept="image/*">
                                        <small class="form-text text-muted">Choose 1 or more</small>
                                        @error('gallery')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <button type="submit"
                                                class="btn btn-success">{{ __('product.add_images') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 " id="panel_images">
                                <div class="row">
                                    @isset($image)
                                        @foreach($image as $key => $value)
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <a href="{{asset($value->src)}}" target="_blank"> <img src="{{asset($value->src)}}" class="card-img-top"
                                                         alt="{{$value->alt}}"></a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$value->title}}</h5>
                                                        <p class="card-text">{{$value->description}}</p>
                                                        <a href="{{route('backend.product.image.set',['id'=>$value->id,'type'=>'Cover','product_id'=>$value->product_id])}}" class="btn btn-primary btn-sm {{ $value->type === "Cover" ? "disabled" : "" }}">Cover</a>
                                                        <a href="{{route('backend.product.image.set',['id'=>$value->id,'type'=>'Main','product_id'=>$value->product_id])}}" class="btn btn-primary btn-sm {{ $value->type === "Main" ? "disabled" : "" }}">Main</a>
                                                        <a href="{{route('backend.product.image.edit',$value->id)}}" class="btn btn-success btn-sm">Edit</a>
                                                        <a class="btn btn-danger btn-sm" href="#"
                                                           onclick="event.preventDefault();document.getElementById('destroy').submit();">
                                                             @lang('product.delete')
                                                        </a>
                                                        <form action="{{ route('backend.product.image.destroy')}}" method="post" id="destroy">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$value->id}}">
                                                            <input type="hidden" name="product_id" value="{{$value->product_id}}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end price lists--}}
                    <div class="card-footer">
                        <a href="{{ route('backend.product.index') }}"
                           class="btn btn-primary">{{ __('product.done') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


