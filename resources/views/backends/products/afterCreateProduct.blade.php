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
                                <h4>@lang('product.periods')</h4>
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
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="float-md-left">
                                                    <b> {{__('product.date')}} : </b>30-01-2019 to 31-12-2019
                                                </div>
                                                <div class="float-md-right">
                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                       class="btn btn-success">@lang('product.add_prices')</a>
                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                       class="btn" data-toggle="tooltip"
                                                       data-placement="top" title="Edit"><i
                                                            class="fas fa-edit fa-2x"></i>
                                                    </a>
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
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>{{__('product.remark')}}</b></td>
                                                                <td colspan="7">Some quick example text to build on the
                                                                    card title and make up the bulk of the card's
                                                                    content.
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
                                                                <td>{{__('product.cost_infra')}}</td>
                                                                <td>{{__('product.public_adult')}}</td>
                                                                <td>{{__('product.public_child')}}</td>
                                                                <td>{{__('product.public_infra')}}</td>
                                                                <td>{{__('setup.action')}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>200.00</td>
                                                                <td>100.00</td>
                                                                <td>0.00</td>
                                                                <td>500.00</td>
                                                                <td>400.00</td>
                                                                <td>100.00</td>
                                                                <td>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn btn-success"><i
                                                                            class="far fa-copy fa-2x"></i></a>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Edit"><i class="fas fa-edit fa-2x"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--period table--}}
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="float-md-left">
                                                    <b> {{__('product.date')}} : </b>30-01-2019 to 31-12-2019
                                                </div>
                                                <div class="float-md-right">
                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                       class="btn btn-success">@lang('product.add_prices')</a>
                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                       class="btn" data-toggle="tooltip"
                                                       data-placement="top" title="Edit"><i
                                                            class="fas fa-edit fa-2x"></i>
                                                    </a>
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
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-check-circle text-success"></i>
                                                                </td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>
                                                                <td><i class="fas fa-times-circle text-danger"></i></td>

                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <table
                                                            class="table table-hover table-sm text-center table-bordered">
                                                            <tbody>
                                                            <tr>
                                                                <td>{{__('product.cost_adult')}}</td>
                                                                <td>{{__('product.cost_child')}}</td>
                                                                <td>{{__('product.cost_infra')}}</td>
                                                                <td>{{__('product.public_adult')}}</td>
                                                                <td>{{__('product.public_child')}}</td>
                                                                <td>{{__('product.public_infra')}}</td>
                                                                <td>{{__('setup.action')}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>200.00</td>
                                                                <td>100.00</td>
                                                                <td>0.00</td>
                                                                <td>500.00</td>
                                                                <td>400.00</td>
                                                                <td>100.00</td>
                                                                <td>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn btn-success"><i
                                                                            class="far fa-copy fa-2x"></i></a>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Edit"><i class="fas fa-edit fa-2x"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>200.00</td>
                                                                <td>100.00</td>
                                                                <td>0.00</td>
                                                                <td>500.00</td>
                                                                <td>400.00</td>
                                                                <td>100.00</td>
                                                                <td>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn btn-success"><i
                                                                            class="far fa-copy fa-2x"></i></a>
                                                                    <a href="{{route('backend.product.period.create',$product->id)}}"
                                                                       class="btn" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Edit"><i class="fas fa-edit fa-2x"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                        <a href="#{{$value->id}}" class="btn btn-success btn-sm">Edit</a>
                                                        <a href="#{{$value->id}}" class="btn btn-danger btn-sm">Delete</a>
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

        });

        function confirm_reset() {
            var reset_button = confirm("Are you sure?");
            if (reset_button) {
                document.getElementById('main-form').reset();
            }
        }
    </script>
@endsection


