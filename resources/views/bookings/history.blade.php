<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
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
    <h2 class="mb-4">Your Booking History</h2>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Booking Time</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->event->name }}</td>
                <td>{{ $booking->event->date }}</td>
                <td>{{ $booking->event->venue }}</td>
                <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No bookings yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $bookings->links() }}
    </div>
</div>
</body>
</html>
