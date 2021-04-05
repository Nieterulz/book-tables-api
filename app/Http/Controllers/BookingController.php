<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Models\Booking;
use App\Models\Table;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Creates a new Booking and stores it
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $table = Table::where('code', $request->get('table_code'))->first();
        $date = Carbon::createFromFormat('d-m-Y', $request->get('date'))->format('Y-m-d');

        $booking = Booking::create([
            'client_name' => $request->get('client_name'),
            'code' => \Str::upper(\Str::random(6)),
            'date' => $date,
            'persons' => $request->get('persons'),
            'table_id' => $table->id,
        ]);

        return response()->json($booking->code, 201);
    }

    /**
     * Deletes a Booking
     *
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $code)
    {
        $booking = Booking::where('code', $code)->first();

        if ($booking === null) {
            return response()->json([
                'errors' => ["Booking with code {$code} does not exist"]
            ], 404);
        }

        $booking->delete();

        return response()->json($booking->id);
    }
}
