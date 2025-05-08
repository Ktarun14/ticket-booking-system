<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid request.'], 422);
        }

        $event = Event::find($request->event_id);

        if ($event->available_seats < 1) {
            return response()->json(['message' => 'No seats available.'], 400);
        }

        // Reduce available seats
        $event->decrement('available_seats');

        // Create booking
        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'booked_at' => now(),
        ]);

        return response()->json([
            'message' => 'Ticket booked successfully!',
            'remaining_seats' => $event->available_seats 
        ]);
        
    }

    public function history()
    {
        $bookings = Booking::with('event')
                    ->where('user_id', Auth::id())
                    ->orderBy('booked_at', 'desc')
                    ->paginate(10);

        return view('bookings.history', compact('bookings'));
    }
}
