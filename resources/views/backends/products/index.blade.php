@extends('backends.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('product.product_management') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Product Type</th>
                                <th>Periods</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($productType as $key => $list)
                                <tr>
                                    <td>{{ $key++ }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        <a href="{{ route('backend.product_type.edit',$list->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <a href="" data-toggle="tooltip" data-placement="top" title="Periods">
                                            <i class="fas fa-calendar-alt fa-2x"></i>
                                        </a><a href="" data-toggle="tooltip" data-placement="top" title="Periods">
                                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                                        </a>
                                        <!--<a href="" data-toggle="tooltip" data-placement="top" title="Reset Password">
                                            <i class="fas fa-recycle fa-2x"></i>
                                        </a>-->
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $productType->links() !!}
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
