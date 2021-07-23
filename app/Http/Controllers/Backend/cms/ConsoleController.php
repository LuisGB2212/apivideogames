<?php

namespace App\Http\Controllers\Backend\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Console;
use Illuminate\Support\Facades\Auth;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consoles = Console::orderBy('name','asc')->paginate(25);

        return response()->json([
            'message' => 'success',
            'data' => $consoles->load('userRegistered'),
            'pagination' => [
                'total' => $consoles->total(),
                'per_page' => $consoles->perPage(),
                'current_page' => $consoles->currentPage(),
                'last_page' => $consoles->lastPage(),
                'from' => $consoles->firstItem(),
                'to' => $consoles->lastItem()
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required'
        ]);

        $console = Console::updateOrCreate(
            [
                'name' => $request->name,
                'year' => $request->year,
            ],
            [
                'registered_id' => Auth::user()->id
            ]
        );

        return response()->json([
            'message' => 'success',
            'data' => $console->load('userRegistered')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Console $console)
    {
        return response()->json([
            'message' => 'success',
            'data' => $console->load('userRegistered')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Console $console)
    {
        $console->fill($request->all());
        $message = 'change';

        if($console->isDirty()){
            $message = 'success';
            $console->save();
        }

        return response()->json([
            'message' => $message,
            'data' => $console
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Console $console)
    {
        $console->delete();
        return response()->json([
            'message' => 'success',
            'data' => $console
        ], 200);
    }
}
