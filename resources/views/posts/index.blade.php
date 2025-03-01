@extends('layouts.app')

@section('title')
    Post list
@endsection


@section('breadcrumb')
    Posts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">
                            {{ __('Posts') }}
                        </div>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New</a>
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
                                        <th scope="col">Code</th>
                                        <th scope="col">Charge</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td>
                                                <div class="card-img-top">
                                                    <img src="{{ asset($post->image) }}" class="rounded-0 shadow-sm card-img" style="width: 60px; height: 60px;"/>
                                                </div>
                                            </td>

                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                {{ $post->code }}
                                            </td>
                                            <td>
                                                {{ $post->charge }}
                                            </td>
                                            <td>
                                                {{ $post->rate }}
                                            </td>
                                            <td>
                                                {{ $post->location }}
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-sm btn-primary me-3"
                                                    href="{{ route('posts.edit', $post->id) }}">Edit</a>

                                                    <form method="POST"
                                                        action="{{ route('posts.destroy', $post->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Post?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Has Empty. Create a New <a href="{{ route('posts.create') }}">Click
                                                    Here</a></td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {!! $posts->links() !!}

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
