@extends('layouts.app')

@section('title')
    Payment Method list
@endsection


@section('breadcrumb')
    Payment Methods
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Payment Methods') }}
                        </div>
                        <a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Create New</a>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($paymentMethods as $payment_method)
                                        <tr>
                                            <td>
                                                <div class="card-img-top">
                                                    <img src="{{ asset($payment_method->image) }}" class="rounded-0 shadow-sm card-img" style="width: 60px; height: 60px;"/>
                                                </div>
                                            </td>

                                            <td>
                                                {{ $payment_method->title }}
                                            </td>
                                            <td>
                                                {{ $payment_method->address }}
                                            </td>
                                           

                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-sm btn-primary me-3"
                                                    href="{{ route('payment-methods.edit', $payment_method->id) }}">Edit</a>

                                                    <form method="POST"
                                                        action="{{ route('payment-methods.destroy', $payment_method->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Payment Method?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Has Empty. Create a New <a href="{{ route('payment-methods.create') }}">Click
                                                    Here</a></td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {!! $paymentMethods->links() !!}

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
