@extends('layouts.app')

@section('title')
    Create Post 
@endsection

@section('breadcrumb')
    Create Post 
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Create New Post') }}
                        </div>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">View List</a>
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

                        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Image *</label>
                                        <input type="file" name="image" class="form-control" id="image" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Name *</label>
                                        <input type="text" name="name" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Code</label>
                                        <input type="text" name="code" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Booking Charge</label>
                                        <input type="number" name="charge" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Package Rate</label>
                                        <input type="number" name="rate" class="form-control" required />
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Home Service</label>
                                        <select name="home_service" class="form-control">
                                            <option value="Available">Available</option>
                                            <option value="Not Available">Not Available</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Incall/Outcall</label>
                                        <select name="type" class="form-control">
                                            <option value="Incall">Incall</option>
                                            <option value="Outcall">Outcall</option>
                                            <option value="Free Room">Free Room</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>

                                <div class="col-12">
                                    <div class="card-img mt-3">
                                        <img id="image-preview" src="#" alt="Preview" class="card-img"
                                            style="display: none;">
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
