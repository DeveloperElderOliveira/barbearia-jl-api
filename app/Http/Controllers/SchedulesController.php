<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->middleware('auth:api');
        $this->schedule = $schedule;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $user = auth('api')->user();
        dd($this->schedule->with('employee','service')->where('user_id',$user['id'])->orderBy('scheduling_date')->get());
        if(!$schedules = $this->schedule->with('employee','service')->where('user_id',$user['id'])->orderBy('scheduling_date')->get());
             return response()->json(['error' => 'schedules not found.'],401);

        return response()->json($schedules);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        if(!$schedule = $this->schedule->create($request->all()))
            return response()->json(['error' => 'schedule not created'],401);

        return response()->json(['schedule' => $schedule]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$schedule = $this->schedule->find($id))
             return response()->json(['error' => 'schedule not found.'],401);

        return response()->json(['schedule' => $schedule]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        if(!$schedule = $this->schedule->find($id))
            return response()->json(['error' => 'update not possible'],401);

        $schedule = $schedule->update($request->all());
        return response()->json(['schedule' => $schedule]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$schedule = $this->schedule->find($id))
            return response()->json(['error' => 'delete not possible'],401);

        $schedule = $schedule->delete();
        return response()->json(['schedule' => $schedule]);
    }
}
