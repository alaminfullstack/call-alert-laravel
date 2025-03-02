@extends('layouts.app')

@section('title')
    Booking list
@endsection


@section('breadcrumb')
    Bookings
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Bookings') }}
                        </div>
                       
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Date/Trx</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Info</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="card-img-top">
                                                    <img src="{{ asset($booking->post->image ?? '') }}" class="rounded-0 shadow-sm card-img" style="width: 60px; height: 60px;"/>
                                                </div>
                                            </td>

                                            <td>
                                                <div>{{ $booking->post->title ?? null }} | {{ $booking->post->code ?? null }}</div>
                                                <div>Charge: {{ $booking->post->charge ?? null }}</div>
                                                <div>Rate: {{ $booking->post->rate ?? null }}</div>
                                            </td>

                                            <td>
                                               <div> {{ $booking->name }}</div>
                                               <div> {{ $booking->mobile }}</div>
                                               <div> {{ $booking->address }}</div>
                                            </td>

                                          
                                            <td>
                                                <div>Date: {{ $booking->date }}</div>
                                                <div>A/C: {{ $booking->account_number }}</div>
                                                <div>TRX: {{ $booking->transaction_id }}</div>
                                            </td>
                                            <td>
                                                <div>Amount: {{ $booking->amount }}</div>
                                                <div>Method: {{ $booking->method }}</div>
                                                <div>Address: {{ $booking->method_address }}</div>
                                            </td>
                                            <td>
                                                <div>Status: {{ $booking->status }}</div>
                                                <div>Home Service: {{ $booking->post->home_service ?? null }}</div>
                                                <div>Type: {{ $booking->post->type ?? null }}</div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    {{-- <a class="btn btn-sm btn-primary me-3" href="{{ route('bookings.show', $booking->id) }}">Details</a> --}}

                                                    <form method="POST"
                                                        action="{{ route('bookings.destroy', $booking->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Booking?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Has Empty</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {!! $bookings->links() !!}

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
