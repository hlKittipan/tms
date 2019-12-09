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
                                <a href="{{ route('backend.booking.create') }}" class="btn btn-primary">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="book_table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Client name</th>
                                <th>Booking date</th>
                                <th width="280px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($quotation)
                                @foreach ($quotation as $key => $list)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $list->first_name ." ".$list->last_name }}</td>
                                        <td>{{ $list->quo_date }}</td>

                                        <td>
                                            <a href="{{ route('backend.booking.edit',$list->id) }}"
                                               data-toggle="tooltip"
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
                            @endisset
                            </tbody>
                        </table>
                        {!! $quotation->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $("#book_table").DataTable();

        })
    </script>
@endsection
