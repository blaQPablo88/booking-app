<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <hr>

    <!-- CREATE TIMESLOT -->
    <h2>Create Timeslot</h2>
    <form method="POST" action="/admin/timeslot">
        @csrf
        <input type="time" name="start_time" required>
        <input type="time" name="end_time" required>
        <button type="submit">Add Timeslot</button>
    </form>

    <hr>

    <!-- ADD EMPLOYEE -->
    <h2>Create Employee</h2>
    <form method="POST" action="/admin/employee">
        @csrf
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="position" placeholder="Role (Technician)" required>
        <button type="submit">Add Employee</button>
    </form>

    <hr>

    
    <!-- ASSIGN EMPLOYEE A TIMESLOT -->
    <h2>Assign Employee to Timeslot (Queue)</h2>
    <form method="POST" action="/admin/assign">
        @csrf

        <label>Timeslot:</label>
        <select name="timeslot_id">
            @foreach($timeslots as $slot)
                <option value="{{ $slot->id }}">
                    {{ $slot->start_time }} - {{ $slot->end_time }}
                </option>
            @endforeach
        </select>

        <label>Employee:</label>
        <select name="employee_id">
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">
                    {{ $emp->full_name }}
                </option>
            @endforeach
        </select>

        <input type="number" name="queue_position" placeholder="Queue Position" required>

        <button type="submit">Assign</button>
    </form>

</body>
</html>
