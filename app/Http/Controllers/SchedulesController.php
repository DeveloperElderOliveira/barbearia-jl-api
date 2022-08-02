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
        
        if(!$schedules = $this->schedule->with('employee','user','services','agendamento_dia_horario')->where('user_id',$user['id'])->orderBy('scheduling_date')->get())
             return response()->json(['error' => 'schedules not found.']);

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
        $dados = $request->all();
        // // dd($dados['servicos']);
        // if(!$schedule = $this->schedule->create($request->all()))
        //     return response()->json(['error' => 'schedule not created']);

        // if(!$services_schedule = $schedule->services()->create($dados['servicos']))
        //     return response()->json(['error' => 'services schedules not created']);

        return response()->json(['schedule' => $dados['servicos'][0]['name']]);
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
             return response()->json(['error' => 'schedule not found.']);

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
            return response()->json(['error' => 'update not possible']);

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
            return response()->json(['error' => 'delete not possible']);

        $schedule = $schedule->delete();
        return response()->json(['schedule' => $schedule]);
    }
}
