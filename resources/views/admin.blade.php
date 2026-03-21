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
                        <input type="text" name="full_name" class="form-control" placeholder="Pontsho Mogotsi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" placeholder="Technician" required>
                    </div>

                    <button class="btn btn-success w-100">Add Employee</button>
                </form>
            </div>
        </div>

        <!-- ASSIGN EMPLOYEE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="mb-3">Assign Employee</h5>

                <form method="POST" action="/admin/assign">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Timeslot</label>
                        <select name="timeslot_id" class="form-select">
                            @foreach($timeslots as $slot)
                                <option value="{{ $slot->id }}">
                                    {{ $slot->start_time }} - {{ $slot->end_time }}
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

</body>
</html>
