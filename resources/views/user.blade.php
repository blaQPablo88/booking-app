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

    <!-- BOOKED SCHEDULES -->
    <div class="container mt-4">

        <h2 class="mb-3">Your Bookings</h2>

        @if($bookings->isEmpty())
            <div class="alert alert-info">
                No bookings yet.
            </div>
        @else

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    {{ $booking->user_email }}
                                </td>

                                <td>
                                    {{ $booking->employeeTimeslot->timeslot->start_time }}
                                    -
                                    {{ $booking->employeeTimeslot->timeslot->end_time }}
                                </td>

                                <td>
                                    {{ $booking->employeeTimeslot->timeslot->start_time }}
                                    -
                                    {{ $booking->employeeTimeslot->timeslot->end_time }}
                                </td>

                                <td>
                                    <form method="POST" action="/user/booking/{{ $booking->id }}/delete">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <hr>


    <!-- AVAILABLE SLOTS -->
    <div class="container mt-5">
        <h2 class="mb-4">Book a Timeslot</h2>

        <!-- POSITION SELECTOR -->
        <div class="mb-4">
            <label class="form-label">Select Service Type</label>
            <select id="positionFilter" class="form-select">
                <option value="">All</option>
                @foreach($positions as $position)
                    <option value="{{ $position }}">{{ $position }}</option>
                @endforeach
            </select>

        </div>

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

    <script>
        document.getElementById('positionFilter').addEventListener('change', function () {
            let selectedPosition = this.value;

            document.querySelectorAll('.timeslot-card').forEach(card => {
                let position = card.getAttribute('data-position');

                if (!selectedPosition || position.includes(selectedPosition)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>


</body>
</html>
