@extends('layouts.app')

@section('title')
    Doctor list
@endsection


@section('breadcrumb')
    Doctors
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Doctors') }}
                        </div>
                        <a href="{{ route('doctors.create') }}" class="btn btn-primary">Create New</a>
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
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($doctors as $doctor)
                                        <tr>
                                            <td>
                                                {{-- <div class="card-img-top">
                                                    <img src="{{ asset($doctor->image) }}" class="rounded-0 shadow-sm card-img" style="width: 60px; height: 60px;"/>
                                                </div> --}}
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                {{ $doctor->name }}
                                            </td>
                                            <td>
                                                {{ $doctor->mobile }}
                                            </td>
                                            <td>
                                                {{ $doctor->email }}
                                            </td>
                                            <td>
                                                {{ $doctor->designation->title ?? null }}
                                            </td>
                                            <td>
                                                {{ $doctor->address }}
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-sm btn-primary me-3"
                                                    href="{{ route('doctors.edit', $doctor->id) }}">Edit</a>

                                                    <form method="POST"
                                                        action="{{ route('doctors.destroy', $doctor->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Doctor?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Has Empty. Create a New <a href="{{ route('doctors.create') }}">Click
                                                    Here</a></td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {!! $doctors->links() !!}

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
