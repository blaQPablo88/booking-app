<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Booking</title>
</head>

<body class="bg-light">

<div class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">User Dashboard</h1>
        <p class="text-muted">Schedule an appointment with our representatives</p>
        <a href="/">
            Go back home
        </a>
    </div>
    <hr>

    <!-- MESSAGES -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    
    @if(session('mechanic'))
        <div class="alert alert-success mt-3">
            Your booking was assigned to <strong>{{ session('mechanic') }}</strong>
        </div>
    @endif

    <!-- AVAILABLE SLOTS -->
    <div class="container mt-5">
        <h2 class="mb-4">Book a Timeslot</h2>

        <!-- TIMESLOTS -->
        <div class="row">

            @foreach($timeslots as $timeslot)
                @php
                    $available = $timeslot->employeeTimeslots
                        ->where('is_assigned', false)
                        ->count();
                @endphp

                <div class="col-md-4 mb-3">

                    <div class="card shadow-sm p-3">

                        <h5 class="card-title">
                            {{ $timeslot->date->format('d M Y') }} | 
                            {{ $timeslot->start_time }} - {{ $timeslot->end_time }}
                        </h5>

                        <form method="POST" action="/book">
                            @csrf

                            <input type="hidden" name="timeslot_id" value="{{ $timeslot->id }}">

                            <input 
                                type="email" 
                                name="email" 
                                class="form-control mb-2"
                                placeholder="Enter your email" 
                                required
                            >

                            @if(!$timeslot->isFull())
                                <button class="btn btn-primary w-100">Book</button>
                            @else
                                <button class="btn btn-secondary w-100" disabled>Fully Booked</button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
