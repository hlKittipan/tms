@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="btn-toolbar justify-content-between" role="toolbar"
                             aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <h4>{{__('book.booking')}} </h4>
                            </div>
                            <h4> Booking NO. : {{$book_no}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h4>Client detail</h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <div><b>Last Name :</b> {{$client->last_name}} <b>First Name :</b> {{$client->first_name}}</div>
                                    <div><b>E-mail :</b> {{$client->email}}</div>
                                    <div><b>Hotel name :</b> {{$client->hotel_name}}</div>
                                    <div><b>Hotel tel :</b> {{$client->hotel_tel}} <b>Room number :</b> {{$client->room_number}}</div>
                                </div>

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
                                            <tr>
                                                <td scope="row">{{$quo->id}}</td>
                                                <td colspan="2">{{$product->name}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Adult</td>
                                                <td>{{$quo->quotation_details[0]->unit_adult}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->public_adult}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->unit_adult * $quo->quotation_details[0]->public_adult}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Child</td>
                                                <td>{{$quo->quotation_details[0]->unit_child}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->public_child}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->unit_child * $quo->quotation_details[0]->public_child}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td>Infant</td>
                                                <td>{{$quo->quotation_details[0]->unit_infant}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->public_infant}}</td>
                                                <td class="text-right">{{$quo->quotation_details[0]->unit_infant * $quo->quotation_details[0]->public_infant}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Total</th>
                                                <td class="text-right">{{$quo->quotation_details[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Vat 7%</th>
                                                <td class="text-right">{{$quo->quotation_details[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-right">Net total</th>
                                                <td class="text-right">{{$quo->quotation_details[0]->net}}</td>
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
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
