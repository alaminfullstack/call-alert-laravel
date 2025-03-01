@extends('layouts.app')

@section('title')
    Edit Patient 
@endsection


@section('breadcrumb')
    Edit Patient 
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Edit Patients') }}
                        </div>
                        <a href="{{ route('patients.index') }}" class="btn btn-primary">View List</a>
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

                        <form action="{{ route('patients.update', $patient->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" id="image" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Mobile</label>
                                        <input type="number" name="mobile" class="form-control" value="{{ $patient->mobile }}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $patient->email }}" />
                                    </div>
                                </div>
                           
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="Male" @if($patient->gender == 'Male') selected @endif>Male</option>
                                            <option value="Female" @if($patient->gender == 'Female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Blood Group</label>
                                        <select name="blood_group" class="form-control">
                                            <option value="O+" @if($patient->blood_group == 'O+') selected @endif>O+</option>
                                            <option value="A+" @if($patient->blood_group == 'A+') selected @endif>A+</option>
                                            <option value="B+" @if($patient->blood_group == 'B+') selected @endif>B+</option>
                                            <option value="AB+" @if($patient->blood_group == 'AB+') selected @endif>AB+</option>
                                            <option value="O-" @if($patient->blood_group == 'O-') selected @endif>O-</option>
                                            <option value="A-" @if($patient->blood_group == 'A-') selected @endif>A-</option>
                                            <option value="B-" @if($patient->blood_group == 'B-') selected @endif>B-</option>
                                            <option value="AB-" @if($patient->blood_group == 'AB-') selected @endif>AB-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ $patient->address }}" />
                                    </div>
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>

                                <div class="col-12">
                                    <div class="card-img mt-3">
                                        <img id="image-preview" src="{{ asset($patient->image) }}" alt="Preview" class="card-img"
                                            style="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').setAttribute('src', e.target.result);
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endpush
