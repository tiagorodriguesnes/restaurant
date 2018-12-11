<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\Table as TableResource;
use Illuminate\Support\Facades\DB;

use App\table;
use App\StoreTableRequest;
use Hash;




class TableControllerAPI extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('page')) {
            return TableResource::collection(table::paginate(5));
        } else {
            return TableResource::collection(table::orderByRaw('table_number')->get());
        }

    }

    public function show($table_number)
    {
        return new TableResource(table::find($table_number));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer',

        ]);
        $table = new table();
        $table->fill($request->all());
        $table->save();
        return response()->json(new TableResource($table), 201);
    }

    public function update(Request $request, $table_number)
    {
        $request->validate([
            'table_number' => 'required|integer',
        ]);
        $table = table::findOrFail($table_number);
        $table->update($request->all());
        return new TableResource($table);
    }

    public function destroy($table_number)
    {
        $table = table::findOrFail($table_number);
        $table->delete();
        return response()->json(null, 204);
    }
}