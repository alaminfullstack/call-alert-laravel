@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <h5>Total Post</h5>
                    <p>{{ $total_post ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <h5>Total Booking</h5>
                    <p>{{ $total_booking ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <h5>Today Booking</h5>
                    <p>{{ $today_booking ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="my-5">Today Booking List</h4>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Post</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($today_bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->date->format('d-m-Y H:i') }}</td>
                                <td>{{ $booking->post->title ?? null }}</td>
                                <td>{{ $booking->name ?? null }}</td>
                                <td>{{ $booking->address }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
