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
                    <div class="card-header">

                        <div class="btn-toolbar justify-content-between" role="toolbar"
                             aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <h4>{{ __('product.product_management') }}</h4>
                            </div>
                            <div class="input-group">
                                <a href="{{ route('backend.product.create') }}" class="btn btn-primary">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Periods</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($product as $key => $list)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        @foreach($list->period as $k => $v)
                                            <b>{{\Carbon\Carbon::parse($v->date_start)->format('F jS, Y')}}</b> to <b>{{\Carbon\Carbon::parse($v->date_end)->format('F jS, Y')}}</b><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('backend.product.after',$list->id) }}" data-toggle="tooltip"
                                           data-placement="top" title="Edit">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        {{--<a href="" data-toggle="tooltip" data-placement="top" title="Periods">
                                            <i class="fas fa-calendar-alt fa-2x"></i>
                                        </a>--}}
                                        <!--<a href="" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                            <i class="fas fa-recycle fa-2x"></i>
                                        </a>-->
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $product->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
