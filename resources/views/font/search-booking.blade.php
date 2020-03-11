@extends('layouts.app')
@section('title', 'Search Booking')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container py-3">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="btn-toolbar justify-content-between" role="toolbar"
                             aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <h4>Search Booking</h4>
                            </div>
                            <h4></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{route('view')}}" method="get">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Last name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="last_name">
                                                <small class="form-text text-muted ">Your last name</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Booking No.</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="booking">
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

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
