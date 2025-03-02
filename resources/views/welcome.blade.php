<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dhaka Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="row">
        <div class="col-md-6 mx-auto">
            {{-- slider --}}
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img src="{{ asset($slider->image) }}" class="d-block w-100"
                                alt="{{ asset($slider->image) }}" style="height: 200px;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="container mt-3">

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


                <div class="card border-0">
                    <div class="card-body p-2">
                        <div>
                            <h5 class="mb-0">Latest Post</h5>
                        </div>

                        <div class="mt-3">
                            @foreach ($posts as $post)
                                <a href="{{ route('details', $post->id) }}" class="d-flex text-decoration-none text-dark" style="gap: 15px;">
                                    <div>
                                        <img src="{{ asset($post->image) }}" alt="" style="height: 100px; width: 100px;" class="rounded-2" />
                                    </div>
                                    <div class="flex-fill">
                                        <div>Available</div>
                                        <div>
                                            <span>
                                                {{ $post->title }}
                                            </span>
                                            |
                                            <span>
                                                Code: {{ $post->code }}
                                            </span>
                                            |
                                            <span>
                                                Rate 8 hour: {{ $post->rate }}
                                            </span>
                                            |
                                            <span>
                                                Address: {{ $post->location }}
                                            </span>
                                        </div>
                                    </div>
                                </a>

                                @if (!$loop->last)
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- latest post  --}}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
