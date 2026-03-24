<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Manage timeslots, employees, and assignments</p>
            <a href="/">
                Go back home
            </a>
        </div>

        <div class="row g-4">

            <!-- CREATE TIMESLOT -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h5 class="mb-3">Create Timeslot</h5>

                    <form method="POST" action="/admin/timeslot">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>

                        <input 
                            type="date" 
                            name="date" 
                            class="form-control mb-3" 
                            min="{{ date('Y-m-d') }}"
                            value="{{ date('Y-m-d') }}"
                            required>

                        <button class="btn btn-primary w-100">Add Timeslot</button>
                    </form>
                </div>
            </div>

            <!-- CREATE EMPLOYEE -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h5 class="mb-3">Create Employee</h5>

                    <form method="POST" action="/admin/employee">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>

                        <button class="btn btn-success w-100">Add Employee</button>
                    </form>
                </div>
            </div>

            <!-- ASSIGN EMPLOYEE -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h5 class="mb-3">Assign Employee</h5>

                    <form method="POST" action="/admin/employee-timeslot">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Timeslot</label>
                            <select name="timeslot_id" class="form-select">
                                @foreach($timeslots as $slot)
                                    <option value="{{ $slot->id }}">
                                        {{ $slot->date->format('d M Y') }} | {{ $slot->start_time }} - {{ $slot->end_time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Employee</label>
                            <select name="employee_id" class="form-select">
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">
                                        {{ $emp->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Queue Position</label>
                            <input type="number" name="queue_position" class="form-control" placeholder="1" required>
                        </div>

                        <button class="btn btn-dark w-100">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- USER BOOKINGS -->
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">All User Bookings</h4>

            @if($bookings->isEmpty())
                <div class="alert alert-info">
                    No bookings available.
                </div>
            @else

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>Email</th>
                                <th>Time</th>
                                <th>Employee</th>
                                <th>Seeking a:</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->user_email }}</td>

                                    <td>
                                        {{ $booking->employeeTimeslot->timeslot->start_time }}
                                        -
                                        {{ $booking->employeeTimeslot->timeslot->end_time }}
                                    </td>

                                    <td>
                                        {{ $booking->employeeTimeslot->employee->full_name }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $booking->employeeTimeslot->employee->position }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
