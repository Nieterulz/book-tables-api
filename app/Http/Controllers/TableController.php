<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{

    // Return all tables
    public function index()
    {
        return Table::all();
    }

    // Stores a table
    public function store(Request $request)
    {
        // Validate request params
        $request->validate([
            'code' => 'required|numeric|unique:tables,code',
            'min_capacity' => 'required|numeric|min:0',
            'max_capacity' => 'required|numeric|min:0|gt:min_capacity'
        ]);

        return Table::create([
            'code' => $request->get('code'),
            'min_capacity' => $request->get('min_capacity'),
            'max_capacity' => $request->get('max_capacity'),
        ]);
    }

    public function destroy(int $id)
    {
        return Table::destroy($id);
    }
}
