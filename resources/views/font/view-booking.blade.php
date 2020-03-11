@extends('layouts.app')
@section('title', 'Booking detail #'.$book->book_no)
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="btn-toolbar justify-content-between" role="toolbar"
                             aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <h4>Booking No. {{$book->book_no}}</h4>
                            </div>
                            <h4>View Booking</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Client detail</h4>
                                    <hr>
                                </div>
                                @foreach($book->client as $key => $value)
                                    <div class="col-md-6">
                                        <div><b>Last Name :</b> {{$value->last_name}} <b>First Name :</b> {{$value->first_name}}</div>
                                        <div><b>E-mail :</b> {{$value->email}}</div>
                                        <div><b>Hotel name :</b> {{$value->hotel_name}}</div>
                                        <div><b>Hotel tel :</b> {{$value->hotel_tel}} <b>Room number :</b> {{$value->room_number}}</div>
                                    </div>
                                    <div class="col-md-6"></div>
                                @endforeach
                                <div class="col-md-11 pt-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="5%">#</th>
                                                <th scope="col" colspan="2" width="25%">Name</th>
                                                <th scope="col" width="5%">QTY</th>
                                                <th scope="col" width="5%">Price</th>
                                                <th scope="col" width="5%">Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($book->detail as $key => $value)
                                            <tr>
                                                <td scope="row">{{$value->id}}</td>
                                                <td colspan="2">{{$value->name}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Adult</td>
                                                <td>{{$value->unit_adult}}</td>
                                                <td class="text-right">{{$value->public_adult}}</td>
                                                <td class="text-right">{{$value->unit_adult * $value->public_adult}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Child</td>
                                                <td>{{$value->unit_child}}</td>
                                                <td class="text-right">{{$value->public_child}}</td>
                                                <td class="text-right">{{$value->unit_child * $value->public_child}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Infant</td>
                                                <td>{{$value->unit_infant}}</td>
                                                <td class="text-right">{{$value->public_infant}}</td>
                                                <td class="text-right">{{$value->unit_infant * $value->public_infant}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Total</th>
                                                <td class="text-right">{{$book->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Vat 7%</th>
                                                <td class="text-right">{{$book->vat}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Net total</th>
                                                <td class="text-right">{{$book->net}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button  onclick="window.print()" class="btn btn-danger">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="checkScheduler" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Select date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="spinner-grow hide" id="loading" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div id='calendar'></div>
                    </div>
                    {{--<div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        });
    </script>
@endsection
