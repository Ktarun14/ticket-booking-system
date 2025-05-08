<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ticket Booking</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.index') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.history') }}">Booking History</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Upcoming Events</h2>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">
                            <strong>Date:</strong> {{ $event->date }}<br>
                            <strong>Venue:</strong> {{ $event->venue }}<br>
                            <strong>Available Seats:</strong> <span id="seats-{{ $event->id }}">{{ $event->available_seats }}</span>
                        </p>
                        <button class="btn btn-primary book-btn" data-id="{{ $event->id }}">Book Ticket</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap + jQuery (optional, for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.book-btn').click(function () {
        let eventId = $(this).data('id');

        $.ajax({
            url: '{{ route("book.ticket") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                event_id: eventId
            },
            success: function (res) {
                alert(res.message);
                $('#seats-' + eventId).text(res.remaining_seats);
            },
            error: function (xhr) {
                let errorMsg = xhr.responseJSON?.message || 'Booking failed.';
                alert(errorMsg);
            }
        });
    });
</script>

</body>
</html>
