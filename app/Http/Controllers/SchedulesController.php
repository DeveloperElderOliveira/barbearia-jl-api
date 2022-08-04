<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\ServicesSchedule;
use Exception;
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
        $valor_total_agendamento = 0;   
        $user = auth('api')->user();
        
        if(!$schedules = $this->schedule->with('employee','user','services','agendamento_dia_horario')->where('user_id',$user['id'])->orderBy('scheduling_date')->get())
             return response()->json(['error' => 'schedules not found.']);

             foreach($schedules as $schedule){
                    foreach($schedule->services as $service){
                        $valor_total_agendamento += $service['price'];
                    }             
             }

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
        try{
            $dados = $request->all();
        
            $schedule = $this->schedule->create($request->all());

            $schedule->agendamento_dia_horario()->create(["dia" => $dados['scheduling_date'],"horario" => $dados['horario']]);

            foreach($dados['servicos'] as $servico) {
                ServicesSchedule::create(["service_id" => $servico['id'], "schedule_id" => $schedule->id]);
            }

            return response()->json(['schedule' => $schedule]);
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],404);
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
