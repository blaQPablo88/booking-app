<!DOCTYPE html>
<html>
<head>
    <title>Admin - Booking System</title>
</head>
<body>

    <h1>Admin Page</h1>

    <!-- CREATE TIMESLOT -->
    <h2>Create Timeslot</h2>
    <form method="POST" action="/timeslots">
        @csrf
        <input type="time" name="start_time" required>
        <input type="time" name="end_time" required>
        <button type="submit">Create</button>
    </form>

    <hr>

    <!-- ADD EMPLOYEE -->
    <h2>Add Employee</h2>
    <form method="POST" action="/employees">
        @csrf
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="position" placeholder="Position" required>
        <button type="submit">Add</button>
    </form>

</body>
</html>
