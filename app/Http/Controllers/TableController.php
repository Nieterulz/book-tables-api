<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableAvailableRequest;
use App\Http\Requests\TableStoreRequest;
use App\Http\Traits\ApiResponser;
use App\Models\Booking;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * Creates a new 'Table' and stores it
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TableStoreRequest $request)
    {
        $table = Table::create([
            'code' => $request->get('code'),
            'min_capacity' => $request->get('min_capacity'),
            'max_capacity' => $request->get('max_capacity'),
        ]);

        return response()->json($table);
    }

    /**
     * Checks availability of Tables for a date and a number of persons
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function availability(TableAvailableRequest $request)
    {
        $date = Carbon::createFromFormat('d-m-Y', $request->get('date'))->format('Y-m-d');

        $notAvailableTableIds = Booking::where('date', $date)->get()->pluck('table_id');

        $persons = $request->get('persons');
        $tables = Table::where('min_capacity', '<=', $persons)
            ->where('max_capacity', '>=', $persons)
            ->whereNotIn('id', $notAvailableTableIds)
            ->get();

        return response()->json($tables);
    }

    /**
     * Deletes a table
     *
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $code)
    {
        $table = Table::where('code', $code)->first();

        if ($table === null) {
            return response()->json([
                'errors' => ["Table with code {$code} does not exist"]
            ], 404);
        }

        $table->delete();

        return response()->json($table->id);
    }
}
