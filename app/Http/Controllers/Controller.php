<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $meets = Meet::paginate(5);
        $events = Meet::select(DB::raw('concat_ws(" - ", name, pet_name) AS title, concat_ws(" ",meet_date, meet_time) AS start , TIME_FORMAT(meet_time, "%h:%i %p") AS descripcion'))->get();

        $date = Carbon::now();

        return view('dashboard',compact('meets', 'events', 'date'));
    }
}
