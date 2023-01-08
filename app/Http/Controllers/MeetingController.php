<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetRequest;
use App\Http\Requests\UpdateMeetRequest;
use App\Models\Meet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meet.create', ['meet' => new Meet]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMeetRequest $request)
    {
        $data = Meet::all();

        $date = Meet::where('meet_date', $request['meet_date'])
            ->where('meet_time', $request['meet_time'])->first();

        if (count($data) == 0) {
            Meet::create($request->all());
            return redirect()->route('dashboard')->with('success', 'La cita se ha creado exitosamente.');
        }

        if($date != null) {
            return redirect()->route('dashboard')->with('danger', 'Ya existe una cita con esa fecha y hora.');
        } else {
            Meet::create($request->all());
            return redirect()->route('dashboard')->with('success', 'La cita se ha creado exitosamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meet = Meet::findOrFail($id);

        return view('meet.edit', compact('meet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $meet = Meet::find($id);

        $meet->meet_date = $request['meet_date'];
        $meet->meet_time = $request['meet_time'];
        $meet->save();

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
