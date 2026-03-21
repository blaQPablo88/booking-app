<!DOCTYPE html>
<html>
<head>
    <title>User Booking</title>
</head>
<body>

    <h1>Book a Timeslot</h1>

    <hr>

    @foreach($timeslots as $slot)
        <div style="margin-bottom: 20px;">
            <strong>
                {{ $slot->start_time }} - {{ $slot->end_time }}
            </strong>

            <form method="POST" action="/user/book">
                @csrf

                <!-- EMAIL INPUT -->
                <input 
                    type="email" 
                    name="user_email" 
                    placeholder="Enter your email" 
                    required
                >

                <!-- hidden timeslot -->
                <input type="hidden" name="timeslot_id" value="{{ $slot->id }}">

                <button type="submit">Book</button>
            </form>
        </div>
    @endforeach

</body>
</html>
