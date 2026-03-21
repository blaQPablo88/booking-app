<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Booking</title>
</head>
<body>

    <h1>User Booking System</h1>

    <!-- MESSAGES -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <hr>

    <!-- BOOKED SCHEDULES -->
    <h2>Your Bookings</h2>

    @if($bookings->isEmpty())
        <p>No bookings yet.</p>
    @else
        @foreach($bookings as $booking)
            <div style="margin-bottom: 10px;">
                📧 {{ $booking->user_email }} —
                🕒 {{ $booking->employeeTimeslot->timeslot->start_time }}
                -
                {{ $booking->employeeTimeslot->timeslot->end_time }}
                {{ $booking->employeeTimeslot->employee->position }}
            </div>
        @endforeach
    @endif
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

            @foreach($employeeTimeslots as $ets)
                <div class="col-md-4 mb-3 timeslot-card" 
                    data-position="{{ $ets->employee->position }}">

                    <div class="card shadow-sm p-3">

                        <h5 class="card-title">
                            {{ $ets->timeslot->start_time }} - {{ $ets->timeslot->end_time }}
                        </h5>

                        <p class="text-muted mb-2">
                            {{ $ets->employee->full_name }} ({{ $ets->employee->position }})
                        </p>

                        <form method="POST" action="/user/book">
                            @csrf

                            <input 
                                type="email" 
                                name="user_email" 
                                class="form-control mb-2"
                                placeholder="Enter your email" 
                                required
                            >

                            <!-- 🔥 IMPORTANT CHANGE -->
                            <input type="hidden" name="employee_timeslot_id" value="{{ $ets->id }}">

                            <button class="btn btn-primary w-100">
                                Book
                            </button>
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
