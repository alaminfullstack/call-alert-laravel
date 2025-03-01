
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
            <div class="py-2 px-3 bg-dark text-white d-flex align-items-center">
                <a href="/">
                    <img style="height: 25px;" src="data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e" />
                </a>

                <strong class="d-block text-center w-100">
                   {{ $post->title }} | Booking
                </strong>
            </div>
            <div class="container mt-3">

                <div class="card border-0 mb-3">
                    <div class="card-body p-2">
                        <div class="mb-3">
                            <img src="{{ asset($post->image) }}" alt="" style="height: 200px;" class="rounded-2 card-img" />
                        </div>

                        <form action="{{ route('booking_save', $post->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name">Mobile</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Enter Your Mobile" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Your Address" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name">Booking Date</label>
                                <input type="datetime-local" name="date" class="form-control" placeholder="Enter Booking Date" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name">Booking Charge</label>
                                <input type="text" readonly name="amount" class="form-control" value="{{ $post->charge }}" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name">Payment Method</label>
                                @foreach ($methods as $method)
                                    <select name="payment_method" class="form-control">
                                        <option value="{{ $method->id }}">{{ $method->title }}</option>
                                    </select>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold">
                                Continue
                            </button>
                        </form>

                       
                    </div>
                </div>

                <div class="card border-0">
                    <div class="card-body p-2">
                        <p class="mb-2 text-danger fw-bold">
                            Terms And Conditions
                        </p>

                        <p>
                            This service is for adults only. Here you will first have to pay an advance service charge of Tk {{ $post->charge }} through bKash or Nagad account and confirm the booking online or on WhatsApp. You will be able to work with the same girl you see in the picture. This is a make up like the real picture. If you want, you can come and work in our own take home service. Work as per the rate, no bargaining is allowed. Pay once the booking is complete
                        </p>

                        <p>
                            You will automatically receive an SMS on your number within 15 minutes.
                        </p>
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
