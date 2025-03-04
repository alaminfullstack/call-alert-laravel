@extends('layouts.app')

@section('title')
    Edit Post 
@endsection


@section('breadcrumb')
    Edit Post 
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Edit Post') }}
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

                        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="name" class="form-control" value="{{ $post->name }}" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Code</label>
                                        <input type="text" name="code" class="form-control" value="{{ $post->code }}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Booking Charge</label>
                                        <input type="number" name="charge" class="form-control" value="{{ $post->charge }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Package Rate</label>
                                        <input type="number" name="rate" class="form-control" value="{{ $post->rate }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Home Service</label>
                                        <select name="home_service" class="form-control">
                                            <option value="Available" @if($post->home_service == 'Available') selected @endif>Available</option>
                                            <option value="Not Available" @if($post->home_service == 'Not Available') selected @endif>Not Available</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Incall/Outcall</label>
                                        <select name="type" class="form-control">
                                            <option value="Incall" @if($post->type == 'Incall') selected @endif>Incall</option>
                                            <option value="Outcall" @if($post->type == 'Outcall') selected @endif>Outcall</option>
                                            <option value="Free Room" @if($post->type == 'Free Room') selected @endif>Free Room</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" value="{{ $post->location }}" />
                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $post->description }}</textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>

                                <div class="col-12">
                                    <div class="card-img mt-3">
                                        <img id="image-preview" src="{{ asset($post->image) }}" alt="Preview" class="card-img"
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
